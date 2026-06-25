<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8"><title>Manajemen Toko - AdminLTE</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@4.0.0-beta2/dist/css/adminlte.min.css">
</head>
<body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
    <div class="app-wrapper py-4 px-4">
        <div class="card shadow-sm border">
            <div class="card-header bg-light d-flex justify-content-between align-items-center">
                <h3 class="card-title text-dark font-weight-bold mb-0"><i class="fa-solid fa-shop text-success me-2"></i> Daftar Toko Mitra</h3>
                <a href="{{ route('admin.dashboard') }}" class="btn btn-sm btn-secondary"><i class="fa-solid fa-arrow-left"></i> Kembali ke Dashboard</a>
            </div>
            <div class="card-body p-0">
                <table class="table table-striped align-middle mb-0">
                    <thead class="table-light"><tr><th class="px-4">ID Toko</th><th>Nama Toko</th><th>Token QR Code</th><th>Koordinat GPS (Lat, Long)</th></tr></thead>
                    <tbody>
                        @forelse($stores as $store)
                        <tr>
                            <td class="px-4">#{{ $store->id }}</td>
                            <td class="font-weight-bold">{{ $store->store_name }}</td>
                            <td><span class="badge bg-dark">{{ $store->qr_code_token }}</span></td>
                            <td>{{ $store->latitude }}, {{ $store->longitude }}</td>
                        </tr>
                        @empty
                        <tr><td colspan="4" class="p-4 text-center text-muted italic">Belum ada data toko mitra.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>