@extends('layouts.app')

@section('title', 'Kelola Penulis')

@section('content')
<div class="container-fluid">
    <div class="card shadow-sm border-0">
        <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
            <h5 class="mb-0 text-dark font-weight-bold">Data Penulis</h5>
            <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#modalTambah">
                + Tambah Penulis
            </button>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-striped table-hover align-middle mb-0">
                    <thead class="table-dark">
                        <tr>
                            <th>FOTO</th>
                            <th>NAMA</th>
                            <th>USERNAME</th>
                            <th>PASSWORD</th>
                            <th class="text-center">AKSI</th>
                        </tr>
                    </thead>
                    <tbody id="tabel-penulis">
                        @forelse($dataPenulis as $p)
                            <tr>
                                <td>
                                    <img src="{{ asset('storage/uploads_penulis/' . $p->foto) }}" width="40" height="40" class="rounded-circle" alt="Foto">
                                </td>
                                <td>{{ $p->nama_depan }} {{ $p->nama_belakang }}</td>
                                <td>{{ $p->user_name }}</td>
                                <td class="text-muted"><small>{{ Str::limit($p->password, 15) }}</small></td>
                                <td class="text-center">
                                    <button class="btn btn-primary btn-sm me-1">Edit</button>
                                    <button class="btn btn-danger btn-sm">Hapus</button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted py-4">
                                    Belum ada data penulis. Silakan tambah data baru.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalTambah" data-bs-backdrop="static" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-bold">Tambah Penulis</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="formTambahPenulis" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="row g-3 mb-3">
                        <div class="col">
                            <label class="form-label small font-weight-bold">Nama Depan</label>
                            <input type="text" name="nama_depan" class="form-control" required>
                        </div>
                        <div class="col">
                            <label class="form-label small font-weight-bold">Nama Belakang</label>
                            <input type="text" name="nama_belakang" class="form-control" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small font-weight-bold">Username</label>
                        <input type="text" name="user_name" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small font-weight-bold">Password</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small font-weight-bold">Foto Profil</label>
                        <input type="file" name="foto" class="form-control" accept="image/*">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success">Simpan Data</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.getElementById('formTambahPenulis').addEventListener('submit', function(e) {
    e.preventDefault();
    let formData = new FormData(this);
    
    fetch('/penulis', {
        method: 'POST',
        body: formData,
        headers: {
            'X-Requested-With': 'XMLHttpRequest'
        }
    })
    .then(response => response.json())
    .then(data => {
        if(data.success) {
            alert('Data berhasil disimpan!');
            location.reload();
        } else {
            alert('Gagal menyimpan data!');
        }
    })
    .catch(error => {
        console.error('Error:', error);
    });
});
</script>
@endsection