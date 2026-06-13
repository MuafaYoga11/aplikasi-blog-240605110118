<!-- resources/views/partials/kategori_modal.blade.php -->
<div class="modal fade" id="kategoriModal" tabindex="-1" aria-labelledby="kategoriModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="kategoriModalLabel">Tambah / Edit Kategori</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form id="kategoriForm">
        <div class="modal-body">
          <input type="hidden" name="id" id="kategoriId">
          <div class="mb-3">
            <label for="namaKategori" class="form-label">Nama Kategori</label>
            <input type="text" class="form-control" name="nama_kategori" id="namaKategori" required>
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
