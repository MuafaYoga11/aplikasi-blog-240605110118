<div class="content-card">
    <div class="card-header border-0 pb-0 pt-4 px-4 bg-white">
        <h5 class="fw-bold"><i class="bi bi-folder2-open me-2"></i>Data Kategori Artikel</h5>
        <button class="btn btn-success btn-sm px-3" onclick="openTambahKategori()">
            <i class="bi bi-plus"></i> Tambah Kategori
        </button>
    </div>
    <div class="table-responsive p-4">
        <table class="table table-hover align-middle mb-0 border-top">
            <thead>
                <tr>
                    <th>NAMA KATEGORI</th>
                    <th>KETERANGAN</th>
                    <th class="text-center">AKSI</th>
                </tr>
            </thead>
            <tbody id="tabel-kategori">
                <tr>
                    <td colspan="3" class="text-center text-muted py-4">Memuat data...</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<div class="modal fade" id="modalTambahKategori" data-bs-backdrop="static" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold">Tambah Kategori</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="formTambahKategori">
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label small fw-semibold">Nama Kategori</label>
                        <input type="text" name="nama_kategori" class="form-control" required>
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-semibold">Keterangan</label>
                        <textarea name="keterangan" class="form-control" rows="3"></textarea>
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

<div class="modal fade" id="modalEditKategori" data-bs-backdrop="static" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold">Edit Kategori</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="formEditKategori">
                <input type="hidden" name="_method" value="PUT">
                <input type="hidden" name="id" id="editKategoriId">
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label small fw-semibold">Nama Kategori</label>
                        <input type="text" name="nama_kategori" id="editNamaKategori" class="form-control" required>
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-semibold">Keterangan</label>
                        <textarea name="keterangan" id="editKeterangan" class="form-control" rows="3"></textarea>
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

<div class="modal fade" id="modalHapusKategori" data-bs-backdrop="static" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content text-center">
            <div class="modal-body py-4">
                <div class="modal-delete-icon">
                    <i class="bi bi-trash3"></i>
                </div>
                <h5 class="fw-bold">Hapus data ini?</h5>
                <p class="text-muted small">Data yang dihapus tidak dapat dikembalikan.</p>
                <input type="hidden" id="hapusKategoriId">
                <div class="d-flex justify-content-center gap-2 mt-3">
                    <button type="button" class="btn btn-batal px-4" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-danger px-4" onclick="confirmHapusKategori()">Ya, Hapus</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function loadKategori() {
    fetch('/kategori-artikel', {
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'Accept': 'application/json'
        }
    })
    .then(res => res.json())
    .then(data => {
        const tbody = document.getElementById('tabel-kategori');
        if (data.length === 0) {
            tbody.innerHTML = '<tr><td colspan="3" class="text-center text-muted py-4 fst-italic">Belum ada data kategori. Silakan tambah data baru.</td></tr>';
            return;
        }
        tbody.innerHTML = data.map(k => `
            <tr>
                <td><span class="badge bg-primary">${k.nama_kategori}</span></td>
                <td>${k.keterangan || '-'}</td>
                <td class="text-center">
                    <button class="btn btn-edit-table btn-sm me-1 px-3" onclick="editKategori(${k.id})"><i class="bi bi-pencil"></i> Edit</button>
                    <button class="btn btn-delete-table btn-sm px-3" onclick="hapusKategori(${k.id})"><i class="bi bi-trash"></i> Hapus</button>
                </td>
            </tr>
        `).join('');
    })
    .catch(err => console.error(err));
}

function openTambahKategori() {
    document.getElementById('formTambahKategori').reset();
    document.querySelectorAll('#formTambahKategori .is-invalid').forEach(el => el.classList.remove('is-invalid'));
    new bootstrap.Modal(document.getElementById('modalTambahKategori')).show();
}

document.getElementById('formTambahKategori').addEventListener('submit', function(e) {
    e.preventDefault();
    const formData = new FormData(this);
    
    fetch('/kategori-artikel', {
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
            bootstrap.Modal.getInstance(document.getElementById('modalTambahKategori')).hide();
            showToast(data.message);
            loadKategori();
        } else {
            showToast(data.message || 'Gagal menyimpan data.', 'error');
        }
    })
    .catch(err => {
        showToast('Terjadi kesalahan.', 'error');
        console.error(err);
    });
});

function editKategori(id) {
    fetch('/kategori-artikel/' + id, {
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'Accept': 'application/json'
        }
    })
    .then(res => res.json())
    .then(data => {
        document.getElementById('editKategoriId').value = data.id;
        document.getElementById('editNamaKategori').value = data.nama_kategori;
        document.getElementById('editKeterangan').value = data.keterangan || '';
        document.querySelectorAll('#formEditKategori .is-invalid').forEach(el => el.classList.remove('is-invalid'));
        new bootstrap.Modal(document.getElementById('modalEditKategori')).show();
    })
    .catch(err => console.error(err));
}

document.getElementById('formEditKategori').addEventListener('submit', function(e) {
    e.preventDefault();
    const id = document.getElementById('editKategoriId').value;
    const formData = new FormData(this);
    
    fetch('/kategori-artikel/' + id, {
        method: 'POST',
        body: formData,
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'X-CSRF-TOKEN': CSRF_TOKEN,
            'Accept': 'application/json'
        }
    })
    .then(res => {
        if (!res.ok && res.status === 422) {
            return res.json().then(data => { throw data; });
        }
        return res.json();
    })
    .then(data => {
        if (data.success) {
            bootstrap.Modal.getInstance(document.getElementById('modalEditKategori')).hide();
            showToast(data.message);
            loadKategori();
        } else {
            showToast(data.message || 'Gagal memperbarui data.', 'error');
        }
    })
    .catch(err => {
        if(err.errors) {
            let msg = '';
            for(let key in err.errors){
                msg += err.errors[key][0] + '\n';
            }
            showToast(msg, 'error');
        } else {
            showToast(err.message || 'Terjadi kesalahan.', 'error');
        }
        console.error(err);
    });
});

function hapusKategori(id) {
    document.getElementById('hapusKategoriId').value = id;
    new bootstrap.Modal(document.getElementById('modalHapusKategori')).show();
}

function confirmHapusKategori() {
    const id = document.getElementById('hapusKategoriId').value;
    
    fetch('/kategori-artikel/' + id, {
        method: 'DELETE',
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'X-CSRF-TOKEN': CSRF_TOKEN,
            'Accept': 'application/json'
        }
    })
    .then(res => {
        if (!res.ok && res.status === 422) {
            return res.json().then(data => { throw data; });
        }
        return res.json();
    })
    .then(data => {
        bootstrap.Modal.getInstance(document.getElementById('modalHapusKategori')).hide();
        if (data.success) {
            showToast(data.message);
            loadKategori();
        } else {
            showToast(data.message || 'Gagal menghapus data.', 'error');
        }
    })
    .catch(err => {
        bootstrap.Modal.getInstance(document.getElementById('modalHapusKategori')).hide();
        showToast(err.message || 'Terjadi kesalahan.', 'error');
        console.error(err);
    });
}

loadKategori();
</script>
