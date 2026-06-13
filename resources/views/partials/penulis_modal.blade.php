<!-- resources/views/partials/penulis_modal.blade.php -->
<div class="modal fade" id="penulisModal" tabindex="-1" aria-labelledby="penulisModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="penulisModalLabel">Tambah / Edit Penulis</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form id="penulisForm">
        <div class="modal-body">
          <input type="hidden" name="id" id="penulisId">
          <div class="mb-3">
            <label for="namaDepan" class="form-label">Nama Depan</label>
            <input type="text" class="form-control" name="nama_depan" id="namaDepan" required>
          </div>
          <div class="mb-3">
            <label for="namaBelakang" class="form-label">Nama Belakang</label>
            <input type="text" class="form-control" name="nama_belakang" id="namaBelakang" required>
          </div>
          <div class="mb-3">
            <label for="userName" class="form-label">Username</label>
            <input type="text" class="form-control" name="user_name" id="userName" required>
          </div>
          <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" name="password" id="password" placeholder="Leave blank to keep current">
          </div>
          <div class="mb-3">
            <label for="foto" class="form-label">Foto (optional)</label>
            <input type="file" class="form-control" name="foto" id="foto">
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
