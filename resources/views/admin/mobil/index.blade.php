@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Data Mobil</h1>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createMobilModal">
            <i class="bi bi-plus-lg"></i> Tambah Mobil
        </button>
    </div>

    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nama Mobil</th>
                    <th>Nomor Plat</th>
                    <th>Merk</th>
                    <th>Warna</th>
                    <th>Tahun</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($mobils as $mobil)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $mobil->nama_mobil }}</td>
                    <td>{{ $mobil->nomor_plat }}</td>
                    <td>{{ $mobil->merk }}</td>
                    <td>{{ $mobil->warna }}</td>
                    <td>{{ $mobil->tahun }}</td>
                    <td>
                        <span class="badge bg-{{ $mobil->status == 'tersedia' ? 'success' : ($mobil->status == 'disewa' ? 'warning' : 'danger') }}">
                            {{ $mobil->status }}
                        </span>
                    </td>
                    <td>
                        <button class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#editMobilModal{{ $mobil->id }}">
                            <i class="bi bi-pencil"></i>
                        </button>
                        <form action="{{ route('admin.mobil.destroy', $mobil->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus?')">
                                <i class="bi bi-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="text-center">Tidak ada data</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Create Modal -->
<div class="modal fade" id="createMobilModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Mobil</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('admin.mobil.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Nama Mobil</label>
                        <input type="text" class="form-control" name="nama_mobil" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nomor Plat</label>
                        <input type="text" class="form-control" name="nomor_plat" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Merk</label>
                        <input type="text" class="form-control" name="merk" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Warna</label>
                        <input type="text" class="form-control" name="warna" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Tahun</label>
                        <input type="number" class="form-control" name="tahun" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Status</label>
                        <select class="form-select" name="status" required>
                            <option value="tersedia">Tersedia</option>
                            <option value="disewa">Disewa</option>
                            <option value="perbaikan">Perbaikan</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Keterangan</label>
                        <textarea class="form-control" name="keterangan" rows="3"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Modals -->
@foreach($mobils as $mobil)
<div class="modal fade" id="editMobilModal{{ $mobil->id }}" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Mobil</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('admin.mobil.update', $mobil->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Nama Mobil</label>
                        <input type="text" class="form-control" name="nama_mobil" value="{{ $mobil->nama_mobil }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nomor Plat</label>
                        <input type="text" class="form-control" name="nomor_plat" value="{{ $mobil->nomor_plat }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Merk</label>
                        <input type="text" class="form-control" name="merk" value="{{ $mobil->merk }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Warna</label>
                        <input type="text" class="form-control" name="warna" value="{{ $mobil->warna }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Tahun</label>
                        <input type="number" class="form-control" name="tahun" value="{{ $mobil->tahun }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Status</label>
                        <select class="form-select" name="status" required>
                            <option value="tersedia" {{ $mobil->status == 'tersedia' ? 'selected' : '' }}>Tersedia</option>
                            <option value="disewa" {{ $mobil->status == 'disewa' ? 'selected' : '' }}>Disewa</option>
                            <option value="perbaikan" {{ $mobil->status == 'perbaikan' ? 'selected' : '' }}>Perbaikan</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Keterangan</label>
                        <textarea class="form-control" name="keterangan" rows="3">{{ $mobil->keterangan }}</textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach
@endsection
