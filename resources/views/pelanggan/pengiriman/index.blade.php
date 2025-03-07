@extends('pelanggan.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Daftar Pengiriman</h1>
        <a href="{{ route('pelanggan.pengiriman.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-lg"></i> Buat Pengiriman
        </a>
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
                            <th>Nama Barang</th>
                            <th>Tujuan</th>
                            <th>Penerima</th>
                            <th>Total Biaya</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($pengiriman as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->nama_barang }}</td>
                            <td>{{ $item->alamat_tujuan }}</td>
                            <td>{{ $item->nama_penerima }}</td>
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
                            <td>
                                <a href="{{ route('pelanggan.pengiriman.show', $item->id) }}"
                                    class="btn btn-sm btn-info">
                                    <i class="bi bi-eye"></i>
                                </a>
                                @if($item->status === 'pending')
                                    <a href="{{ route('pelanggan.pengiriman.edit', $item->id) }}"
                                        class="btn btn-sm btn-warning">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form action="{{ route('pelanggan.pengiriman.destroy', $item->id) }}"
                                        method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger"
                                            onclick="return confirm('Yakin ingin menghapus pengiriman ini?')">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center">Tidak ada data pengiriman</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
