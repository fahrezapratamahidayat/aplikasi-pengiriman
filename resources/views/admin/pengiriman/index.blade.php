@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Manajemen Pengiriman</h1>
    </div>

    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Pelanggan</th>
                            <th>Barang</th>
                            <th>Tujuan</th>
                            <th>Total Biaya</th>
                            <th>Status</th>
                            <th>Supir</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($pengiriman as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->pelanggan->name }}</td>
                            <td>{{ $item->nama_barang }}</td>
                            <td>{{ $item->alamat_tujuan }}</td>
                            <td>Rp {{ number_format($item->total_harga, 0, ',', '.') }}</td>
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
                            <td>{{ $item->supir->name ?? '-' }}</td>
                            <td>
                                <a href="{{ route('admin.pengiriman.show', $item->id) }}"
                                    class="btn btn-sm btn-info">
                                    <i class="bi bi-eye"></i>
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="text-center">Tidak ada data pengiriman</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
