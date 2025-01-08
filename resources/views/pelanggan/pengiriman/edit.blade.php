@extends('pelanggan.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Edit Pengiriman</h1>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('pelanggan.pengiriman.update', $pengiriman->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label class="form-label">Nama Barang</label>
                            <input type="text" class="form-control @error('nama_barang') is-invalid @enderror"
                                name="nama_barang" value="{{ old('nama_barang', $pengiriman->nama_barang) }}" required>
                            @error('nama_barang')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label class="form-label">Berat (kg)</label>
                                    <input type="number" step="0.1" class="form-control @error('berat') is-invalid @enderror"
                                        name="berat" value="{{ old('berat', $pengiriman->berat) }}" required>
                                    @error('berat')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label class="form-label">Panjang (cm)</label>
                                    <input type="number" class="form-control @error('panjang') is-invalid @enderror"
                                        name="panjang" value="{{ old('panjang', $pengiriman->panjang) }}" required>
                                    @error('panjang')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label class="form-label">Lebar (cm)</label>
                                    <input type="number" class="form-control @error('lebar') is-invalid @enderror"
                                        name="lebar" value="{{ old('lebar', $pengiriman->lebar) }}" required>
                                    @error('lebar')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label class="form-label">Tinggi (cm)</label>
                                    <input type="number" class="form-control @error('tinggi') is-invalid @enderror"
                                        name="tinggi" value="{{ old('tinggi', $pengiriman->tinggi) }}" required>
                                    @error('tinggi')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Alamat Pickup</label>
                            <textarea class="form-control @error('alamat_pickup') is-invalid @enderror"
                                name="alamat_pickup" rows="2" required>{{ old('alamat_pickup', $pengiriman->alamat_pickup) }}</textarea>
                            @error('alamat_pickup')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Alamat Tujuan</label>
                            <textarea class="form-control @error('alamat_tujuan') is-invalid @enderror"
                                name="alamat_tujuan" rows="2" required>{{ old('alamat_tujuan', $pengiriman->alamat_tujuan) }}</textarea>
                            @error('alamat_tujuan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Nama Penerima</label>
                                    <input type="text" class="form-control @error('nama_penerima') is-invalid @enderror"
                                        name="nama_penerima" value="{{ old('nama_penerima', $pengiriman->nama_penerima) }}" required>
                                    @error('nama_penerima')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">No. Telp Penerima</label>
                                    <input type="text" class="form-control @error('telp_penerima') is-invalid @enderror"
                                        name="telp_penerima" value="{{ old('telp_penerima', $pengiriman->telp_penerima) }}" required>
                                    @error('telp_penerima')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Catatan</label>
                            <textarea class="form-control @error('catatan') is-invalid @enderror"
                                name="catatan" rows="2">{{ old('catatan', $pengiriman->catatan) }}</textarea>
                            @error('catatan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="text-end">
                            <a href="{{ route('pelanggan.pengiriman.index') }}" class="btn btn-secondary">Batal</a>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Informasi Biaya</h5>
                    <p class="card-text">
                        Biaya pengiriman dihitung berdasarkan berat barang:
                        <br>
                        Rp 10.000 / kg
                    </p>
                    <div class="alert alert-info">
                        Total biaya akan dihitung otomatis setelah Anda memasukkan berat barang.
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.querySelector('input[name="berat"]').addEventListener('input', function(e) {
    const berat = parseFloat(e.target.value) || 0;
    const hargaPerKg = 10000;
    const totalHarga = berat * hargaPerKg;

    const formatter = new Intl.NumberFormat('id-ID', {
        style: 'currency',
        currency: 'IDR'
    });

    document.querySelector('.alert-info').innerHTML = `
        Total biaya pengiriman: <strong>${formatter.format(totalHarga)}</strong>
    `;
});
</script>
@endpush
