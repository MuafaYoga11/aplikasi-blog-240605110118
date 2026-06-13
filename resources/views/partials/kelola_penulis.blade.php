{{-- Partial: Kelola Penulis --}}
<div class="content-card">
    <div class="card-header border-0 pb-0 pt-4 px-4 bg-white">
        <h5 class="fw-bold"><i class="bi bi-people me-2"></i>Data Penulis</h5>
        <button class="btn btn-success btn-sm px-3" onclick="openTambahPenulis()">
            <i class="bi bi-plus"></i> Tambah Penulis
        </button>
    </div>
    <div class="table-responsive p-4">
        <table class="table table-hover align-middle mb-0 border-top">
            <thead>
                <tr>
                    <th>FOTO</th>
                    <th>NAMA</th>
                    <th>USERNAME</th>
                    <th>PASSWORD</th>
                    <th class="text-center">AKSI</th>
                </tr>
            </thead>
            <tbody id="tabel-penulis">
                <tr>
                    <td colspan="5" class="text-center text-muted py-4">Memuat data...</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

{{-- Modal Tambah Penulis --}}
<div class="modal fade" id="modalTambahPenulis" data-bs-backdrop="static" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold">Tambah Penulis</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="formTambahPenulis" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="row g-3 mb-3">
                        <div class="col">
                            <label class="form-label small fw-bold">Nama Depan</label>
                            <input type="text" name="nama_depan" class="form-control" required>
                        </div>
                        <div class="col">
                            <label class="form-label small fw-bold">Nama Belakang</label>
                            <input type="text" name="nama_belakang" class="form-control" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Username</label>
                        <input type="text" name="user_name" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Password</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-semibold">Foto Profil</label>
                        <input type="file" name="foto" class="form-control" accept="image/jpeg,image/png">
                        <div class="invalid-feedback"></div>
                    </div>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-batal px-4" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success px-4">Simpan Data</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Modal Edit Penulis --}}
<div class="modal fade" id="modalEditPenulis" data-bs-backdrop="static" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold">Edit Penulis</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="formEditPenulis" enctype="multipart/form-data">
                <input type="hidden" name="_method" value="PUT">
                <input type="hidden" name="id" id="editPenulisId">
                <div class="modal-body">
                    <div class="row g-3 mb-3">
                        <div class="col">
                            <label class="form-label small fw-bold">Nama Depan</label>
                            <input type="text" name="nama_depan" id="editNamaDepan" class="form-control" required>
                        </div>
                        <div class="col">
                            <label class="form-label small fw-bold">Nama Belakang</label>
                            <input type="text" name="nama_belakang" id="editNamaBelakang" class="form-control" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Username</label>
                        <input type="text" name="user_name" id="editUserName" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Password Baru (kosongkan jika tidak diganti)</label>
                        <input type="password" name="password" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-semibold">Foto Profil (kosongkan jika tidak diganti)</label>
                        <div class="mb-2">
                            <img id="previewFotoEdit" src="" alt="Preview" class="rounded border" style="width: 80px; height: 80px; object-fit: cover; display: none;">
                        </div>
                        <input type="file" name="foto" id="editFotoInput" class="form-control" accept="image/jpeg,image/png">
                        <div class="invalid-feedback"></div>
                    </div>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-batal px-4" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success px-4">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Modal Konfirmasi Hapus --}}
<div class="modal fade" id="modalHapusPenulis" data-bs-backdrop="static" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content text-center">
            <div class="modal-body py-4">
                <div class="modal-delete-icon">
                    <i class="bi bi-trash3"></i>
                </div>
                <h5 class="fw-bold">Hapus data ini?</h5>
                <p class="text-muted small">Data yang dihapus tidak dapat dikembalikan.</p>
                <input type="hidden" id="hapusPenulisId">
                <div class="d-flex justify-content-center gap-2 mt-3">
                    <button type="button" class="btn btn-batal px-4" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-danger px-4" onclick="confirmHapusPenulis()">Ya, Hapus</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// ===================== KELOLA PENULIS =====================

function loadPenulis() {
    fetch('/penulis', {
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'Accept': 'application/json'
        }
    })
    .then(res => res.json())
    .then(data => {
        const tbody = document.getElementById('tabel-penulis');
        if (data.length === 0) {
            tbody.innerHTML = '<tr><td colspan="5" class="text-center text-muted py-4 fst-italic">Belum ada data penulis. Silakan tambah data baru.</td></tr>';
            return;
        }
        tbody.innerHTML = data.map(p => `
            <tr>
                <td><img src="/storage/uploads_penulis/${p.foto || 'default.png'}" class="photo-thumb" alt="Foto" onerror="this.src='/storage/uploads_penulis/default.png'"></td>
                <td>${p.nama_depan} ${p.nama_belakang}</td>
                <td>${p.user_name}</td>
                <td class="text-muted"><small>${(p.password || '$2y$10$...').substring(0, 20)}...</small></td>
                <td class="text-center">
                    <button class="btn btn-edit-table btn-sm me-1 px-3" onclick="editPenulis(${p.id})"><i class="bi bi-pencil"></i> Edit</button>
                    <button class="btn btn-delete-table btn-sm px-3" onclick="hapusPenulis(${p.id})"><i class="bi bi-trash"></i> Hapus</button>
                </td>
            </tr>
        `).join('');
    })
    .catch(err => console.error('Error loading penulis:', err));
}

function openTambahPenulis() {
    document.getElementById('formTambahPenulis').reset();
    document.querySelectorAll('#formTambahPenulis .is-invalid').forEach(el => el.classList.remove('is-invalid'));
    new bootstrap.Modal(document.getElementById('modalTambahPenulis')).show();
}

// Submit tambah penulis
document.getElementById('formTambahPenulis').addEventListener('submit', function(e) {
    e.preventDefault();
    const formData = new FormData(this);

    fetch('/penulis', {
        method: 'POST',
        body: formData,
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'X-CSRF-TOKEN': CSRF_TOKEN,
            'Accept': 'application/json'
        }
    })
    .then(res => res.json())
    .then(data => {
        if (data.success) {
            bootstrap.Modal.getInstance(document.getElementById('modalTambahPenulis')).hide();
            showToast(data.message);
            loadPenulis();
        } else {
            showToast(data.message || 'Gagal menyimpan data.', 'error');
        }
    })
    .catch(err => {
        showToast('Terjadi kesalahan.', 'error');
        console.error(err);
    });
});

// Edit penulis
function editPenulis(id) {
    fetch('/penulis/' + id, {
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'Accept': 'application/json'
        }
    })
    .then(res => res.json())
    .then(data => {
        document.getElementById('editPenulisId').value = data.id;
        document.getElementById('editNamaDepan').value = data.nama_depan;
        document.getElementById('editNamaBelakang').value = data.nama_belakang;
        document.getElementById('editUserName').value = data.user_name;
        
        const preview = document.getElementById('previewFotoEdit');
        if (data.foto) {
            preview.src = '/storage/uploads_penulis/' + data.foto;
            preview.style.display = 'block';
        } else {
            preview.style.display = 'none';
        }
        document.querySelectorAll('#formEditPenulis .is-invalid').forEach(el => el.classList.remove('is-invalid'));

        new bootstrap.Modal(document.getElementById('modalEditPenulis')).show();
    })
    .catch(err => console.error(err));
}

// Submit edit penulis
document.getElementById('formEditPenulis').addEventListener('submit', function(e) {
    e.preventDefault();
    const id = document.getElementById('editPenulisId').value;
    const formData = new FormData(this);

    fetch('/penulis/' + id, {
        method: 'POST',
        body: formData,
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'X-CSRF-TOKEN': CSRF_TOKEN,
            'Accept': 'application/json'
        }
    })
    .then(res => res.json())
    .then(data => {
        if (data.success) {
            bootstrap.Modal.getInstance(document.getElementById('modalEditPenulis')).hide();
            showToast(data.message);
            loadPenulis();
        } else {
            showToast(data.message || 'Gagal memperbarui data.', 'error');
        }
    })
    .catch(err => {
        showToast('Terjadi kesalahan.', 'error');
        console.error(err);
    });
});

// Hapus penulis - open confirmation modal
function hapusPenulis(id) {
    document.getElementById('hapusPenulisId').value = id;
    new bootstrap.Modal(document.getElementById('modalHapusPenulis')).show();
}

// Confirm hapus penulis
function confirmHapusPenulis() {
    const id = document.getElementById('hapusPenulisId').value;

    fetch('/penulis/' + id, {
        method: 'DELETE',
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'X-CSRF-TOKEN': CSRF_TOKEN,
            'Accept': 'application/json'
        }
    })
    .then(res => res.json())
    .then(data => {
        bootstrap.Modal.getInstance(document.getElementById('modalHapusPenulis')).hide();
        if (data.success) {
            showToast(data.message);
            loadPenulis();
        } else {
            showToast(data.message || 'Gagal menghapus data.', 'error');
        }
    })
    .catch(err => {
        bootstrap.Modal.getInstance(document.getElementById('modalHapusPenulis')).hide();
        showToast('Terjadi kesalahan.', 'error');
        console.error(err);
    });
}

// Initial load
loadPenulis();
</script>
