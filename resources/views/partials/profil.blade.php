<div class="content-card">
    <div class="card-header border-0 pb-0 pt-4 px-4 bg-white">
        <h5 class="fw-bold"><i class="bi bi-person-circle me-2"></i>Profil Saya</h5>
    </div>
    <div class="card-body p-4">
        <form id="formEditProfil" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-4 text-center mb-4">
                    @php
                        $fotoUrl = $user && $user->foto && $user->foto !== 'default.png' 
                            ? asset('storage/uploads_penulis/' . $user->foto) 
                            : asset('storage/uploads_penulis/default.png');
                    @endphp
                    <img src="{{ $fotoUrl }}" id="previewProfil" class="rounded-circle border mb-3" style="width: 150px; height: 150px; object-fit: cover;">
                    <div>
                        <label for="fotoProfil" class="btn btn-outline-success btn-sm"><i class="bi bi-camera"></i> Ganti Foto</label>
                        <input type="file" name="foto" id="fotoProfil" class="d-none" accept="image/jpeg,image/png" onchange="previewImage(this)">
                        <div class="invalid-feedback d-block" id="error-foto"></div>
                    </div>
                    <small class="text-muted d-block mt-2">Format: JPG, PNG. Maks 2MB.</small>
                </div>
                <div class="col-md-8">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label small fw-semibold">Nama Depan</label>
                            <input type="text" name="nama_depan" class="form-control" value="{{ $user->nama_depan }}" required>
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-semibold">Nama Belakang</label>
                            <input type="text" name="nama_belakang" class="form-control" value="{{ $user->nama_belakang }}" required>
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-semibold">Username</label>
                            <input type="text" name="user_name" class="form-control" value="{{ $user->user_name }}" required>
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-semibold">Password Baru</label>
                            <input type="password" name="password" class="form-control" placeholder="Kosongkan jika tidak diganti">
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>
                    <div class="mt-4 text-end">
                        <button type="submit" class="btn btn-success px-4">Simpan Profil</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<script>
function previewImage(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('previewProfil').src = e.target.result;
        }
        reader.readAsDataURL(input.files[0]);
    }
}

document.getElementById('formEditProfil').addEventListener('submit', function(e) {
    e.preventDefault();
    document.querySelectorAll('#formEditProfil .is-invalid').forEach(el => el.classList.remove('is-invalid'));
    document.getElementById('error-foto').textContent = '';
    
    const formData = new FormData(this);
    
    fetch('/profil', {
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
            showToast(data.message);
            setTimeout(() => { window.location.reload(); }, 1000);
        } else {
            showToast(data.message || 'Gagal memperbarui profil.', 'error');
        }
    })
    .catch(err => {
        if(err.errors) {
            for(let key in err.errors){
                if (key === 'foto') {
                    document.getElementById('error-foto').textContent = err.errors[key][0];
                } else {
                    let input = document.querySelector(`#formEditProfil [name="${key}"]`);
                    if(input) {
                        input.classList.add('is-invalid');
                        let feedback = input.nextElementSibling;
                        if(feedback && feedback.classList.contains('invalid-feedback')) {
                            feedback.textContent = err.errors[key][0];
                        }
                    }
                }
            }
        } else {
            showToast('Terjadi kesalahan.', 'error');
        }
        console.error(err);
    });
});
</script>
