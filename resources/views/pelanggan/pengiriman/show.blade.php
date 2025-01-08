@extends('pelanggan.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Detail Pengiriman</h1>
        <a href="{{ route('pelanggan.pengiriman.index') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Kembali
        </a>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="card-title">Informasi Barang</h5>
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <strong>Nama Barang:</strong>
                            <p>{{ $pengiriman->nama_barang }}</p>
                        </div>
                        <div class="col-md-4">
                            <strong>Berat:</strong>
                            <p>{{ $pengiriman->berat }} kg</p>
                        </div>
                        <div class="col-md-4">
                            <strong>Ukuran:</strong>
                            <p>{{ $pengiriman->panjang }}x{{ $pengiriman->lebar }}x{{ $pengiriman->tinggi }} cm</p>
                        </div>
                    </div>

                    <h5 class="card-title">Informasi Pengiriman</h5>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <strong>Alamat Pickup:</strong>
                            <p>{{ $pengiriman->alamat_pickup }}</p>
                        </div>
                        <div class="col-md-6">
                            <strong>Alamat Tujuan:</strong>
                            <p>{{ $pengiriman->alamat_tujuan }}</p>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <strong>Nama Penerima:</strong>
                            <p>{{ $pengiriman->nama_penerima }}</p>
                        </div>
                        <div class="col-md-6">
                            <strong>No. Telp Penerima:</strong>
                            <p>{{ $pengiriman->telp_penerima }}</p>
                        </div>
                    </div>

                    @if($pengiriman->catatan)
                    <div class="mb-3">
                        <strong>Catatan:</strong>
                        <p>{{ $pengiriman->catatan }}</p>
                    </div>
                    @endif
                </div>
            </div>

            @if($pengiriman->status !== 'pending' && $pengiriman->status !== 'rejected')
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Tracking Pengiriman</h5>
                    <div class="timeline">
                        @forelse($pengiriman->tracking as $track)
                        <div class="timeline-item">
                            <div class="timeline-date">
                                {{ $track->created_at->format('d M Y H:i') }}
                            </div>
                            <div class="timeline-content">
                                <p>{{ $track->keterangan ?? 'Update lokasi' }}</p>
                                <small>
                                    <a href="{{ $track->maps_link }}" target="_blank" class="btn btn-sm btn-outline-primary">
                                        <i class="bi bi-geo-alt"></i> Lihat di Maps
                                    </a>
                                </small>
                            </div>
                        </div>
                        @empty
                        <p class="text-muted">Belum ada update tracking</p>
                        @endforelse
                    </div>
                </div>
            </div>
            @endif
        </div>

        <div class="col-md-4">
            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="card-title">Status Pengiriman</h5>
                    <div class="alert alert-{{
                        $pengiriman->status === 'pending' ? 'warning' :
                        ($pengiriman->status === 'approved' ? 'success' :
                        ($pengiriman->status === 'rejected' ? 'danger' :
                        ($pengiriman->status === 'pickup' ? 'info' :
                        ($pengiriman->status === 'dalam_pengiriman' ? 'primary' : 'secondary'))))
                    }}">
                        {{ ucfirst($pengiriman->status) }}
                    </div>

                    <h6>Total Biaya</h6>
                    <p class="h3">Rp {{ number_format($pengiriman->total_harga, 0, ',', '.') }}</p>

                    @if($pengiriman->supir)
                    <h6 class="mt-3">Informasi Kurir</h6>
                    <p>
                        <strong>Nama:</strong> {{ $pengiriman->supir->name }}<br>
                        <strong>No. HP:</strong> {{ $pengiriman->supir->no_hp }}
                    </p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.timeline {
    position: relative;
    padding: 20px 0;
}
.timeline-item {
    padding: 10px 0;
    border-left: 2px solid #dee2e6;
    padding-left: 20px;
    position: relative;
}
.timeline-item::before {
    content: '';
    position: absolute;
    left: -7px;
    top: 15px;
    width: 12px;
    height: 12px;
    background: #fff;
    border: 2px solid #007bff;
    border-radius: 50%;
}
.timeline-date {
    font-size: 0.85rem;
    color: #6c757d;
}
.timeline-content {
    margin-top: 5px;
}
</style>
@endsection
