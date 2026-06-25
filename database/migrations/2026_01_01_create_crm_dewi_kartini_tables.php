<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        // 1. TABEL TOKO
        Schema::create('stores', function (Blueprint $table) {
            $table->id();
            $table->string('store_name');
            $table->string('qr_code_token')->unique();
            $table->decimal('latitude', 10, 8);
            $table->decimal('longitude', 11, 8);
            $table->timestamps();
        });

        // 2. TABEL ABSENSI / KUNJUNGAN SALES
        Schema::create('visits', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('store_id')->constrained()->onDelete('cascade');
            $table->timestamp('check_in_time');
            $table->timestamp('check_out_time')->nullable();
            $table->string('selfie_image');
            $table->string('display_image')->nullable();
            $table->timestamps();
        });

        // 3. TABEL LAPORAN STOK KACANG BAWANG
        Schema::create('stock_reports', function (Blueprint $table) {
            $table->id();
            $table->foreignId('visit_id')->constrained()->onDelete('cascade');
            $table->string('product_variant'); // Misal: Kacang Bawang 250g, 500g
            $table->integer('current_stock');   // Sisa stok di toko
            $table->integer('order_quantity')->default(0); // Pesanan baru
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('stock_reports');
        Schema::dropIfExists('visits');
        Schema::dropIfExists('stores');
    }
};