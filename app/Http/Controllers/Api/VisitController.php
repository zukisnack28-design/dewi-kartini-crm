<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Store;
use App\Models\Visit;
use App\Models\StockReport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class VisitController extends Controller {
    
    // 1. PROSES SALES MASUK TOKO (CHECK-IN)
    public function checkIn(Request $request) {
        $validator = Validator::make($request->all(), [
            'qr_token' => 'required|string',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'selfie' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'errors' => $validator->errors()], 422);
        }

        // Cek apakah QR Code Toko Valid
        $store = Store::where('qr_code_token', $request->qr_token)->first();
        if (!$store) {
            return response()->json(['status' => 'error', 'message' => 'QR Code Toko Tidak Valid!'], 404);
        }

        // Hitung jarak sales dengan lokasi toko menggunakan Rumus Haversine
        $distance = $this->calculateDistance(
            $request->latitude, $request->longitude, 
            $store->latitude, $store->longitude
        );

        // Validasi Jarak Geofencing Keras (Maksimal toleransi 50 Meter)
        if ($distance > 50) {
            return response()->json([
                'status' => 'error', 
                'message' => 'Gagal Check-In. Jarak Anda terlalu jauh dari toko (' . round($distance) . ' meter).'
            ], 403);
        }

        // Simpan File Foto Selfie Sales ke folder storage/app/public/selfies
        $selfiePath = $request->file('selfie')->store('selfies', 'public');

        // Simpan Log Absensi Masuk
        $visit = Visit::create([
            'user_id' => auth()->id() ?? 1, // ID Sales (Default 1 jika fitur login belum aktif)
            'store_id' => $store->id,
            'check_in_time' => Carbon::now(),
            'selfie_image' => $selfiePath,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Berhasil Check-In di ' . $store->store_name,
            'visit_id' => $visit->id
        ], 200);
    }

    // 2. PROSES SALES SELESAI KUNJUNGAN (CHECK-OUT + INPUT STOK)
    public function checkOut(Request $request, $id) {
        $validator = Validator::make($request->all(), [
            'display_image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'stocks' => 'required|array',
            'stocks.*.variant' => 'required|string',
            'stocks.*.current_stock' => 'required|integer|min:0',
            'stocks.*.order_quantity' => 'integer|min:0',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'errors' => $validator->errors()], 422);
        }

        $visit = Visit::findOrFail($id);
        if ($visit->check_out_time) {
            return response()->json(['status' => 'error', 'message' => 'Kunjungan ini sudah check-out!'], 400);
        }

        // Simpan Foto Bukti Rak Pajangan Produk
        $displayPath = $request->file('display_image')->store('displays', 'public');

        // Simpan Laporan Jumlah Sisa Stok Produk Kacang Bawang di Toko
        foreach ($request->stocks as $stockData) {
            StockReport::create([
                'visit_id' => $visit->id,
                'product_variant' => $stockData['variant'],
                'current_stock' => $stockData['current_stock'],
                'order_quantity' => $stockData['order_quantity'] ?? 0,
            ]);
        }

        // Kunci Waktu Selesai Kunjungan
        $visit->update([
            'check_out_time' => Carbon::now(),
            'display_image' => $displayPath,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Berhasil Check-Out. Laporan kunjungan dan stok telah disimpan.'
        ], 200);
    }

    // Algoritma Utama Kalkulator Jarak Koordinat Bumi (Meter)
    private function calculateDistance($lat1, $lon1, $lat2, $lon2) {
        $earthRadius = 6371000; // Satuan Meter
        $dLat = deg2rad($lat2 - $lat1);
        $dLon = deg2rad($lon2 - $lon1);

        $a = sin($dLat / 2) * sin($dLat / 2) +
             cos(deg2rad($lat1)) * cos(deg2rad($lat2)) *
             sin($dLon / 2) * sin($dLon / 2);
        
        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));
        return $earthRadius * $c; 
    }
}