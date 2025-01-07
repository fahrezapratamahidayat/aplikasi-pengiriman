@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <!-- Page Title -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
        <div>
            <span class="text-muted">{{ now()->format('l, d F Y') }}</span>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="row">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card stats-card border-start border-primary border-4">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <div class="text-muted small">Total Pengiriman</div>
                            <div class="h3 mb-0">{{ $totalPengiriman ?? 0 }}</div>
                        </div>
                        <div class="text-primary">
                            <i class="bi bi-box-seam fs-1"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card stats-card border-start border-success border-4">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <div class="text-muted small">Pengiriman Selesai</div>
                            <div class="h3 mb-0">{{ $pengirimanSelesai ?? 0 }}</div>
                        </div>
                        <div class="text-success">
                            <i class="bi bi-check-circle fs-1"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card stats-card border-start border-warning border-4">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <div class="text-muted small">Dalam Pengiriman</div>
                            <div class="h3 mb-0">{{ $dalamPengiriman ?? 0 }}</div>
                        </div>
                        <div class="text-warning">
                            <i class="bi bi-truck fs-1"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card stats-card border-start border-info border-4">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <div class="text-muted small">Total Pendapatan</div>
                            <div class="h3 mb-0">Rp {{ number_format($totalPendapatan ?? 0, 0, ',', '.') }}</div>
                        </div>
                        <div class="text-info">
                            <i class="bi bi-wallet2 fs-1"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Orders & Performance -->
    <div class="row">
        <!-- Recent Orders -->
        <div class="col-xl-8 mb-4">
            <div class="card">
                <div class="card-header bg-white">
                    <h5 class="card-title mb-0">Pengiriman Terbaru</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Pelanggan</th>
                                    <th>Tujuan</th>
                                    <th>Status</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($recentPengiriman ?? [] as $item)
                                <tr>
                                    <td>#{{ $item->id }}</td>
                                    <td>{{ $item->pelanggan->name }}</td>
                                    <td>{{ $item->alamat_tujuan }}</td>
                                    <td>
                                        <span class="badge bg-{{
                                            $item->status === 'pending' ? 'warning' :
                                            ($item->status === 'approved' ? 'success' :
                                            ($item->status === 'rejected' ? 'danger' :
                                            ($item->status === 'pickup' ? 'info' :
                                            ($item->status === 'dalam_pengiriman' ? 'primary' : 'secondary'))))
                                        }}">
                                            {{ ucfirst($item->status) }}
                                        </span>
                                    </td>
                                    <td>Rp {{ number_format($item->total_harga, 0, ',', '.') }}</td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center">Tidak ada data pengiriman</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Performance Stats -->
        <div class="col-xl-4 mb-4">
            <div class="card">
                <div class="card-header bg-white">
                    <h5 class="card-title mb-0">Performa Kurir</h5>
                </div>
                <div class="card-body">
                    @forelse($kurirPerformance ?? [] as $kurir)
                    <div class="d-flex align-items-center mb-3">
                        <div class="flex-shrink-0">
                            <div class="avatar bg-light-primary rounded">
                                <i class="bi bi-person"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="mb-0">{{ $kurir->name }}</h6>
                            <small class="text-muted">{{ $kurir->completed_deliveries }} pengiriman selesai</small>
                        </div>
                        <div class="text-end">
                            <span class="badge bg-success">{{ $kurir->success_rate }}%</span>
                        </div>
                    </div>
                    @empty
                    <p class="text-center text-muted">Belum ada data performa</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
