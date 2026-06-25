<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dewi Kartini CRM - AdminLTE Dashboard</title>
    
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Theme style AdminLTE 4 (Bootstrap 5 Based) via CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@4.0.0-beta2/dist/css/adminlte.min.css">
</head>
<body class="layout-fixed sidebar-expand-lg bg-body-tertiary">

    <div class="app-wrapper">
        
        <!-- NAVBAR ATAS (HEADER) -->
        <nav class="app-header navbar navbar-expand bg-body shadow-sm">
            <div class="container-fluid">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" data-lte-toggle="sidebar" href="#" role="button">
                            <i class="fa-solid fa-bars"></i>
                        </a>
                    </li>
                    <li class="nav-item d-none d-md-inline-block">
                        <span class="nav-link font-weight-bold text-dark">Sistem Monitoring Sales Lapangan "Dewi Kartini"</span>
                    </li>
                </ul>
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <span class="nav-link text-secondary"><i class="fa-solid fa-user-shield"></i> Admin Owner</span>
                    </li>
                </ul>
            </div>
        </nav>

        <!-- SIDEBAR KIRI (NAVIGASI AdminLTE) -->
        <aside class="app-sidebar bg-dark shadow" data-bs-theme="dark">
            <div class="sidebar-brand">
                <a href="#" class="brand-link text-center py-3">
                    <span class="brand-text font-weight-light text-warning font-weight-bold">
                        <i class="fa-solid fa-cookie-bite"></i> <b>DK</b> KACANG BAWANG
                    </span>
                </a>
            </div>
            <div class="sidebar-wrapper">
                <nav class="mt-3">
                    <ul class="nav flex-column nav-pills" data-lte-toggle="treeview" role="menu" data-accordion="false">
                        <li class="nav-item">
                            <a href="{{ route('admin.dashboard') }}" class="nav-link active">
                                <i class="nav-icon fa-solid fa-gauge-high"></i>
                                <p>Dashboard Utama</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.stores') }}" class="nav-link">
                                <i class="nav-icon fa-solid fa-shop"></i>
                                <p>Manajemen Toko</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.marketing') }}" class="nav-link">
                                <i class="nav-icon fa-solid fa-users"></i>
                                <p>Tim Marketing</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.stocks') }}" class="nav-link">
                                <i class="nav-icon fa-solid fa-boxes-stacked"></i>
                                <p>Laporan Stok Rak</p>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>

        <!-- KONTEN UTAMA HALAMAN -->
        <main class="app-main py-4">
            <div class="container-fluid">
                
                <!-- ROW KOTAK STATISTIK (WIDGETS) -->
                <div class="row g-4 mb-4">
                    <!-- Widget 1: Total Kunjungan -->
                    <div class="col-12 col-sm-6 col-md-4">
                        <div class="info-box shadow-sm border">
                            <span class="info-box-icon bg-primary text-white"><i class="fa-solid fa-route"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text text-muted text-uppercase font-weight-bold" style="font-size: 0.8rem;">Total Kunjungan</span>
                                <span class="info-box-number fs-3 font-weight-bold text-dark">{{ $totalKunjungan }}</span>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Widget 2: Toko Mitra -->
                    <div class="col-12 col-sm-6 col-md-4">
                        <div class="info-box shadow-sm border">
                            <span class="info-box-icon bg-success text-white"><i class="fa-solid fa-store"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text text-muted text-uppercase font-weight-bold" style="font-size: 0.8rem;">Mitra Terdaftar</span>
                                <span class="info-box-number fs-3 font-weight-bold text-dark">{{ $totalToko }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Widget 3: Peringatan Stok -->
                    <div class="col-12 col-sm-6 col-md-4">
                        <div class="info-box shadow-sm border">
                            <span class="info-box-icon bg-danger text-white"><i class="fa-solid fa-triangle-exclamation"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text text-muted text-uppercase font-weight-bold" style="font-size: 0.8rem;">Stok Menipis (&lt; 5)</span>
                                <span class="info-box-number fs-3 font-weight-bold text-danger">{{ $stokMenipis }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ROW TABEL LIVE MONITORING -->
                <div class="row">
                    <div class="col-12">
                        <div class="card shadow-sm border">
                            <div class="card-header bg-light d-flex justify-content-between align-items-center">
                                <h3 class="card-title text-dark font-weight-bold mb-0">
                                    <i class="fa-solid fa-clock-rotate-left text-primary me-2"></i> Log Live Kunjungan Sales Lapangan
                                </h3>
                                <span class="badge bg-primary-subtle text-primary border border-primary-subtle rounded-pill px-3">10 Terkini</span>
                            </div>
                            <div class="card-body p-0 table-responsive">
                                <table class="table table-striped table-hover align-middle mb-0">
                                    <thead class="table-light">
                                        <tr class="text-uppercase font-weight-bold text-secondary" style="font-size: 0.75rem;">
                                            <th class="px-4 py-3">Waktu Masuk</th>
                                            <th class="py-3">Nama Toko</th>
                                            <th class="py-3">Foto Selfie Masuk</th>
                                            <th class="py-3">Laporan Sisa Stok Barang</th>
                                            <th class="py-3">Foto Display Rak</th>
                                            <th class="px-4 py-3 text-center">Status Sesi</th>
                                        </tr>
                                    </thead>
                                    <tbody style="font-size: 0.9rem;">
                                        @forelse($recentVisits as $visit)
                                        <tr>
                                            <td class="px-4 font-weight-medium text-secondary">{{ $visit->check_in_time }}</td>
                                            <td>
                                                <div class="font-weight-bold text-dark">{{ $visit->store->store_name ?? 'Toko Tidak Diketahui' }}</div>
                                                <small class="text-muted">ID Toko: #{{ $visit->store_id }}</small>
                                            </td>
                                            <td>
                                                <img src="{{ asset('storage/' . $visit->selfie_image) }}" class="rounded shadow-sm border object-cover" width="48" height="48" onerror="this.src='https://placehold.co/100x100?text=Selfie'">
                                            </td>
                                            <td>
                                                <div class="d-flex flex-column gap-1">
                                                @forelse($visit->stockReports as $stock)
                                                    <div style="font-size: 0.8rem;">
                                                        <span class="text-dark font-weight-bold">{{ $stock->product_variant }}:</span> 
                                                        Sisa <span class="badge bg-secondary text-white">{{ $stock->current_stock }}</span> 
                                                        | Order: <span class="text-primary font-weight-bold">{{ $stock->order_quantity }}</span>
                                                    </div>
                                                @empty
                                                    <span class="text-muted italic" style="font-size: 0.8rem;">Sedang berada di lokasi (Belum Check-out)</span>
                                                @endforelse
                                                </div>
                                            </td>
                                            <td>
                                                @if($visit->display_image)
                                                    <img src="{{ asset('storage/' . $visit->display_image) }}" class="rounded shadow-sm border object-cover" width="48" height="48">
                                                @else
                                                    <span class="text-warning font-weight-medium" style="font-size: 0.8rem;"><i class="fa-solid fa-spinner fa-spin me-1"></i> Sedang Proses</span>
                                                @endif
                                            </td>
                                            <td class="px-4 text-center">
                                                @if($visit->check_out_time)
                                                    <span class="badge bg-success-subtle text-success border border-success-subtle px-3 py-2 rounded">
                                                        <i class="fa-solid fa-circle-check me-1"></i> Selesai
                                                    </span>
                                                @else
                                                    <span class="badge bg-warning-subtle text-warning border border-warning-subtle px-3 py-2 rounded placeholder-glow">
                                                        <i class="fa-solid fa-location-dot me-1 animate-bounce"></i> Di Lokasi
                                                    </span>
                                                @endif
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="6" class="p-5 text-center text-muted italic">Belum ada aktivitas kunjungan dari sales lapangan hari ini.</td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </main>
    </div>

    <!-- AdminLTE & Bootstrap JS Dependency via CDN -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/admin-lte@4.0.0-beta2/dist/js/adminlte.min.js"></script>
</body>
</html>