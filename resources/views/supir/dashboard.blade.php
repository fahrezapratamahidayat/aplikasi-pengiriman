@extends('supir.layouts.app')

@section('content')
<div class="container-fluid">
    <!-- Page Title -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
        <div class="text-muted">{{ now()->format('l, d F Y') }}</div>
    </div>

    <!-- Stats Cards -->
    <div class="row">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-start border-primary border-4">
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
            <div class="card border-start border-success border-4">
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
            <div class="card border-start border-warning border-4">
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
            <div class="card border-start border-info border-4">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <div class="text-muted small">Kendaraan</div>
                            <div class="h3 mb-0">{{ $mobil->nama_mobil ?? '-' }}</div>
                            <small class="text-muted">{{ $mobil->nomor_plat ?? '' }}</small>
                        </div>
                        <div class="text-info">
                            <i class="bi bi-truck fs-1"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Active Deliveries -->
    <div class="card">
        <div class="card-header bg-white">
            <h5 class="card-title mb-0">Pengiriman Aktif</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Barang</th>
                            <th>Pickup</th>
                            <th>Tujuan</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($activePengiriman ?? [] as $item)
                        <tr>
                            <td>#{{ $item->id }}</td>
                            <td>{{ $item->nama_barang }}</td>
                            <td>{{ $item->alamat_pickup }}</td>
                            <td>{{ $item->alamat_tujuan }}</td>
                            <td>
                                <span class="badge bg-{{
                                    $item->status === 'approved' ? 'success' :
                                    ($item->status === 'pickup' ? 'info' :
                                    ($item->status === 'dalam_pengiriman' ? 'primary' : 'secondary'))
                                }}">
                                    {{ ucfirst($item->status) }}
                                </span>
                            </td>
                            <td>
                                <a href="{{ route('supir.pengiriman.show', $item->id) }}"
                                   class="btn btn-sm btn-info">
                                    <i class="bi bi-eye"></i>
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center">Tidak ada pengiriman aktif</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
