@extends('supir.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Detail Pengiriman</h1>
        <a href="{{ route('supir.pengiriman.index') }}" class="btn btn-secondary">
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

            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Tracking Pengiriman</h5>
                    <div class="timeline mb-4">
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

                    <form id="updateLokasiForm" class="mb-3">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Link Google Maps</label>
                                    <input type="text" class="form-control" name="maps_link" id="maps_link"
                                        placeholder="Contoh: https://maps.app.goo.gl/2BC1NdqLeuPexa2k6" required>
                                    <small class="text-muted">Share lokasi dari Google Maps</small>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Keterangan Update</label>
                                    <input type="text" class="form-control" name="keterangan"
                                        placeholder="Contoh: Barang sedang dalam perjalanan">
                                </div>
                            </div>
                        </div>
                        <div class="alert alert-info">
                            <i class="bi bi-info-circle"></i> Cara mendapatkan link:
                            <ol class="mb-0">
                                <li>Buka Google Maps</li>
                                <li>Pilih lokasi yang dituju</li>
                                <li>Klik tombol Share/Bagikan</li>
                                <li>Pilih "Copy Link" atau "Salin Link"</li>
                            </ol>
                        </div>
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-geo-alt"></i> Update Lokasi
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="card-title">Status Pengiriman</h5>
                    <div class="alert alert-{{
                        $pengiriman->status === 'approved' ? 'success' :
                        ($pengiriman->status === 'pickup' ? 'info' :
                        ($pengiriman->status === 'dalam_pengiriman' ? 'primary' : 'secondary'))
                    }}">
                        {{ ucfirst($pengiriman->status) }}
                    </div>

                    <form action="{{ route('supir.pengiriman.updateStatus', $pengiriman->id) }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Update Status</label>
                            <select class="form-select" name="status" required>
                                <option value="pickup" {{ $pengiriman->status === 'pickup' ? 'selected' : '' }}>
                                    Pickup Barang
                                </option>
                                <option value="dalam_pengiriman" {{ $pengiriman->status === 'dalam_pengiriman' ? 'selected' : '' }}>
                                    Dalam Pengiriman
                                </option>
                                <option value="selesai" {{ $pengiriman->status === 'selesai' ? 'selected' : '' }}>
                                    Selesai
                                </option>
                            </select>
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">Update Status</button>
                        </div>
                    </form>

                    <hr>
                    <h6>Informasi Mobil</h6>
                    <p>
                        <strong>Mobil:</strong> {{ $pengiriman->mobil->nama_mobil }}<br>
                        <strong>Plat:</strong> {{ $pengiriman->mobil->nomor_plat }}
                    </p>
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

@push('scripts')
<script>
document.getElementById('updateLokasiForm').addEventListener('submit', function(e) {
    e.preventDefault();

    const mapsLink = document.getElementById('maps_link').value;
    const keterangan = document.querySelector('input[name="keterangan"]').value;

    // Kirim data ke server
    fetch('{{ route("supir.pengiriman.updateLokasi", $pengiriman->id) }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        },
        body: JSON.stringify({
            maps_link: mapsLink,  // Ubah dari latitude/longitude ke maps_link
            keterangan: keterangan
        })
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.json();
    })
    .then(data => {
        alert('Lokasi berhasil diupdate');
        location.reload();
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Gagal mengupdate lokasi: ' + error.message);
    });
});
</script>
@endpush
@endsection
