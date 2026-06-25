<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8"><title>Laporan Stok Rak - AdminLTE</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@4.0.0-beta2/dist/css/adminlte.min.css">
</head>
<body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
    <div class="app-wrapper py-4 px-4">
        <div class="card shadow-sm border">
            <div class="card-header bg-light d-flex justify-content-between align-items-center">
                <h3 class="card-title text-dark font-weight-bold mb-0"><i class="fa-solid fa-boxes-stacked text-danger me-2"></i> Laporan Sisa Stok Rak Toko</h3>
                <a href="{{ route('admin.dashboard') }}" class="btn btn-sm btn-secondary"><i class="fa-solid fa-arrow-left"></i> Kembali</a>
            </div>
            <div class="card-body p-0">
                <table class="table table-striped align-middle mb-0">
                    <thead class="table-light"><tr><th class="px-4">Tanggal Laporan</th><th>Asal Toko</th><th>Varian Produk</th><th>Sisa Stok di Rak</th><th>Jumlah Pesanan Baru (Order)</th></tr></thead>
                    <tbody>
                        @forelse($stocks as $stock)
                        <tr>
                            <td class="px-4">{{ $stock->created_at }}</td>
                            <td class="font-weight-bold">{{ $stock->visit->store->store_name ?? 'N/A' }}</td>
                            <td><span class="badge bg-secondary">{{ $stock->product_variant }}</span></td>
                            <td class="font-weight-bold text-danger">{{ $stock->current_stock }} pcs</td>
                            <td class="font-weight-bold text-primary">{{ $stock->order_quantity }} pcs</td>
                        </tr>
                        @empty
                        <tr><td colspan="5" class="p-4 text-center text-muted italic">Belum ada laporan stok produk yang masuk.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>