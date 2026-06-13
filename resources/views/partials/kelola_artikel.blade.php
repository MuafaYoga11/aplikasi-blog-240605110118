<div class="content-card">
    <div class="card-header border-0 pb-0 pt-4 px-4 bg-white">
        <h5 class="fw-bold"><i class="bi bi-file-earmark-text me-2"></i>Data Artikel</h5>
        <button class="btn btn-success btn-sm px-3" onclick="openTambahArtikel()">
            <i class="bi bi-plus"></i> Tambah Artikel
        </button>
    </div>
    <div class="table-responsive p-4">
        <table class="table table-hover align-middle mb-0 border-top">
            <thead>
                <tr>
                    <th>GAMBAR</th>
                    <th>JUDUL</th>
                    <th>KATEGORI</th>
                    <th>PENULIS</th>
                    <th>TANGGAL</th>
                    <th class="text-center">AKSI</th>
                </tr>
            </thead>
            <tbody id="tabel-artikel">
                <tr>
                    <td colspan="6" class="text-center text-muted py-4">Memuat data...</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<div class="modal fade" id="modalTambahArtikel" data-bs-backdrop="static" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold">Tambah Artikel</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="formTambahArtikel" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Judul</label>
                        <input type="text" name="judul" class="form-control" placeholder="Judul artikel..." required>
                    </div>
                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label class="form-label small fw-bold">Penulis</label>
                            <select name="id_penulis" class="form-select" required>
                                <option value="">-- Pilih Penulis --</option>
                                @foreach($penulis as $p)
                                <option value="{{ $p->id }}">{{ $p->nama_depan }} {{ $p->nama_belakang }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-bold">Kategori</label>
                            <select name="id_kategori" class="form-select" required>
                                <option value="">-- Pilih Kategori --</option>
                                @foreach($kategori as $k)
                                <option value="{{ $k->id }}">{{ $k->nama_kategori }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-semibold">Isi Artikel</label>
                        <textarea name="isi" class="form-control" rows="5" placeholder="Tulis isi artikel di sini..." required></textarea>
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-semibold">Gambar</label>
                        <input type="file" name="gambar" class="form-control" accept="image/jpeg,image/png" required>
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

<div class="modal fade" id="modalEditArtikel" data-bs-backdrop="static" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold">Edit Artikel</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="formEditArtikel" enctype="multipart/form-data">
                <input type="hidden" name="_method" value="PUT">
                <input type="hidden" name="id" id="editArtikelId">
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Judul</label>
                        <input type="text" name="judul" id="editJudul" class="form-control" required>
                    </div>
                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label class="form-label small fw-bold">Penulis</label>
                            <select name="id_penulis" id="editIdPenulis" class="form-select" required>
                                <option value="">-- Pilih Penulis --</option>
                                @foreach($penulis as $p)
                                <option value="{{ $p->id }}">{{ $p->nama_depan }} {{ $p->nama_belakang }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-bold">Kategori</label>
                            <select name="id_kategori" id="editIdKategori" class="form-select" required>
                                <option value="">-- Pilih Kategori --</option>
                                @foreach($kategori as $k)
                                <option value="{{ $k->id }}">{{ $k->nama_kategori }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-semibold">Isi Artikel</label>
                        <textarea name="isi" id="editIsi" class="form-control" rows="5" required></textarea>
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-semibold">Gambar (kosongkan jika tidak diganti)</label>
                        <div class="mb-2">
                            <img id="previewGambarEdit" src="" alt="Preview" class="rounded border" style="width: 120px; height: 80px; object-fit: cover; display: none;">
                        </div>
                        <input type="file" name="gambar" class="form-control" accept="image/jpeg,image/png">
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

<div class="modal fade" id="modalHapusArtikel" data-bs-backdrop="static" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content text-center">
            <div class="modal-body py-4">
                <div class="modal-delete-icon">
                    <i class="bi bi-trash3"></i>
                </div>
                <h5 class="fw-bold">Hapus data ini?</h5>
                <p class="text-muted small">Data yang dihapus tidak dapat dikembalikan.</p>
                <input type="hidden" id="hapusArtikelId">
                <div class="d-flex justify-content-center gap-2 mt-3">
                    <button type="button" class="btn btn-batal px-4" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-danger px-4" onclick="confirmHapusArtikel()">Ya, Hapus</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function loadArtikel() {
    fetch('/artikel', {
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'Accept': 'application/json'
        }
    })
    .then(res => res.json())
    .then(data => {
        const tbody = document.getElementById('tabel-artikel');
        if (data.length === 0) {
            tbody.innerHTML = '<tr><td colspan="6" class="text-center text-muted py-4 fst-italic">Belum ada data artikel. Silakan tambah data baru.</td></tr>';
            return;
        }
        tbody.innerHTML = data.map(a => {
            const penulisNama = a.penulis ? (a.penulis.nama_depan + ' ' + a.penulis.nama_belakang) : '-';
            const kategoriNama = a.kategori ? a.kategori.nama_kategori : '-';
            
            let badgeClass = 'bg-secondary';
            if(kategoriNama.toLowerCase() === 'tutorial') badgeClass = 'bg-primary';
            else if(kategoriNama.toLowerCase() === 'database') badgeClass = 'bg-danger';
            else if(kategoriNama.toLowerCase() === 'programming') badgeClass = 'bg-info';
            else if(kategoriNama.toLowerCase() === 'framework') badgeClass = 'bg-success';

            return `
            <tr>
                <td><img src="/storage/uploads_artikel/${a.gambar}" class="article-thumb" alt="Gambar"></td>
                <td>${a.judul}</td>
                <td><span class="badge ${badgeClass}">${kategoriNama}</span></td>
                <td>${penulisNama}</td>
                <td><small class="text-muted">${a.hari_tanggal}</small></td>
                <td class="text-center">
                    <button class="btn btn-edit-table btn-sm me-1 px-3" onclick="editArtikel(${a.id})"><i class="bi bi-pencil"></i> Edit</button>
                    <button class="btn btn-delete-table btn-sm px-3" onclick="hapusArtikel(${a.id})"><i class="bi bi-trash"></i> Hapus</button>
                </td>
            </tr>
        `}).join('');
    })
    .catch(err => console.error(err));
}

function openTambahArtikel() {
    document.getElementById('formTambahArtikel').reset();
    document.querySelectorAll('#formTambahArtikel .is-invalid').forEach(el => el.classList.remove('is-invalid'));
    new bootstrap.Modal(document.getElementById('modalTambahArtikel')).show();
}

document.getElementById('formTambahArtikel').addEventListener('submit', function(e) {
    e.preventDefault();
    const formData = new FormData(this);
    
    fetch('/artikel', {
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
            bootstrap.Modal.getInstance(document.getElementById('modalTambahArtikel')).hide();
            showToast(data.message);
            loadArtikel();
        } else {
            showToast(data.message || 'Gagal menyimpan data.', 'error');
        }
    })
    .catch(err => {
        if(err.errors) {
            for(let key in err.errors){
                let input = document.querySelector(`#formTambahArtikel [name="${key}"]`);
                if(input) {
                    input.classList.add('is-invalid');
                    let feedback = input.nextElementSibling;
                    if(feedback && feedback.classList.contains('invalid-feedback')) {
                        feedback.textContent = err.errors[key][0];
                    }
                }
            }
        } else {
            showToast('Terjadi kesalahan.', 'error');
        }
        console.error(err);
    });
});

function editArtikel(id) {
    fetch('/artikel/' + id, {
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'Accept': 'application/json'
        }
    })
    .then(res => res.json())
    .then(data => {
        document.getElementById('editArtikelId').value = data.id;
        document.getElementById('editJudul').value = data.judul;
        document.getElementById('editIdPenulis').value = data.id_penulis;
        document.getElementById('editIdKategori').value = data.id_kategori;
        document.getElementById('editIsi').value = data.isi;
        
        const preview = document.getElementById('previewGambarEdit');
        if (data.gambar) {
            preview.src = '/storage/uploads_artikel/' + data.gambar;
            preview.style.display = 'block';
        } else {
            preview.style.display = 'none';
        }
        document.querySelectorAll('#formEditArtikel .is-invalid').forEach(el => el.classList.remove('is-invalid'));

        new bootstrap.Modal(document.getElementById('modalEditArtikel')).show();
    })
    .catch(err => console.error(err));
}

document.getElementById('formEditArtikel').addEventListener('submit', function(e) {
    e.preventDefault();
    const id = document.getElementById('editArtikelId').value;
    const formData = new FormData(this);
    
    fetch('/artikel/' + id, {
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
            bootstrap.Modal.getInstance(document.getElementById('modalEditArtikel')).hide();
            showToast(data.message);
            loadArtikel();
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
            showToast('Terjadi kesalahan.', 'error');
        }
        console.error(err);
    });
});

function hapusArtikel(id) {
    document.getElementById('hapusArtikelId').value = id;
    new bootstrap.Modal(document.getElementById('modalHapusArtikel')).show();
}

function confirmHapusArtikel() {
    const id = document.getElementById('hapusArtikelId').value;
    
    fetch('/artikel/' + id, {
        method: 'DELETE',
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'X-CSRF-TOKEN': CSRF_TOKEN,
            'Accept': 'application/json'
        }
    })
    .then(res => res.json())
    .then(data => {
        bootstrap.Modal.getInstance(document.getElementById('modalHapusArtikel')).hide();
        if (data.success) {
            showToast(data.message);
            loadArtikel();
        } else {
            showToast(data.message || 'Gagal menghapus data.', 'error');
        }
    })
    .catch(err => {
        bootstrap.Modal.getInstance(document.getElementById('modalHapusArtikel')).hide();
        showToast('Terjadi kesalahan.', 'error');
        console.error(err);
    });
}

loadArtikel();
</script>
