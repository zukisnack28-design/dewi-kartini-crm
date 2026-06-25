<?php

namespace App\Http\Controllers;

use App\Models\Visit;
use App\Models\Store;
use App\Models\StockReport;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller {
    
    // 1. HALAMAN UTAMA DASHBOARD
    public function index() {
        $totalKunjungan = Visit::count();
        $totalToko = Store::count();
        $stokMenipis = StockReport::where('current_stock', '<', 5)->count();

        $recentVisits = Visit::with(['store', 'stockReports'])
                            ->orderBy('check_in_time', 'desc')
                            ->take(10)
                            ->get();

        return view('admin.dashboard', compact('totalKunjungan', 'totalToko', 'stokMenipis', 'recentVisits'));
    }

    // 2. HALAMAN MANAJEMEN TOKO
    public function stores() {
        $stores = Store::orderBy('store_name', 'asc')->get();
        return view('admin.stores', compact('stores'));
    }

    // 3. HALAMAN TIM MARKETING / SALES
    public function marketing() {
        // Mengambil riwayat absen sales yang aktif maupun selesai
        $visits = Visit::with('store')->orderBy('check_in_time', 'desc')->get();
        return view('admin.marketing', compact('visits'));
    }

    // 4. HALAMAN LAPORAN STOK RAK KACANG BAWANG
    public function stocks() {
        $stocks = StockReport::with('visit.store')->orderBy('created_at', 'desc')->get();
        return view('admin.stocks', compact('stocks'));
    }
}