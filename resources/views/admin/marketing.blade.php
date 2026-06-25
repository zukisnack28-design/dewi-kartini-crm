<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8"><title>Tim Marketing - AdminLTE</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@4.0.0-beta2/dist/css/adminlte.min.css">
</head>
<body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
    <div class="app-wrapper py-4 px-4">
        <div class="card shadow-sm border">
            <div class="card-header bg-light d-flex justify-content-between align-items-center">
                <h3 class="card-title text-dark font-weight-bold mb-0"><i class="fa-solid fa-users text-primary me-2"></i> Log Absensi & Kunjungan Tim Marketing</h3>
                <a href="{{ route('admin.dashboard') }}" class="btn btn-sm btn-secondary"><i class="fa-solid fa-arrow-left"></i> Kembali</a>
            </div>
            <div class="card-body p-0">
                <table class="table table-striped align-middle mb-0">
                    <thead class="table-light"><tr><th class="px-4">Waktu Check-In</th><th>Nama Toko</th><th>Foto Selfie</th><th>Waktu Check-Out</th></tr></thead>
                    <tbody>
                        @forelse($visits as $visit)
                        <tr>
                            <td class="px-4">{{ $visit->check_in_time }}</td>
                            <td class="font-weight-bold">{{ $visit->store->store_name ?? 'N/A' }}</td>
                            <td><img src="{{ asset('storage/' . $visit->selfie_image) }}" width="40" height="40" class="rounded border" onerror="this.src='https://placehold.co/100x100?text=Selfie'"></td>
                            <td>{{ $visit->check_out_time ?? 'Masih di lokasi' }}</td>
                        </tr>
                        @empty
                        <tr><td colspan="4" class="p-4 text-center text-muted italic">Belum ada log aktivitas marketing.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>