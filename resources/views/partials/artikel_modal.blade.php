@php
/**
 * resources/views/partials/artikel_modal.blade.php
 * Bootstrap 5 modal for Artikel create/edit.
 */
@endphp
<div class="modal fade" id="artikelModal" tabindex="-1" aria-labelledby="artikelModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="artikelModalLabel">@{{ modalTitle }}</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="artikelForm">
          <input type="hidden" name="id" id="artikelId" />
          <div class="mb-3">
            <label for="judul" class="form-label">Judul</label>
            <input type="text" class="form-control" id="judul" name="judul" required />
          </div>
          <div class="mb-3">
            <label for="isi" class="form-label">Isi</label>
            <textarea class="form-control" id="isi" name="isi" rows="4" required></textarea>
          </div>
          <div class="mb-3">
            <label for="penulis_id" class="form-label">Penulis</label>
            <select class="form-select" id="penulis_id" name="penulis_id" required></select>
          </div>
          <div class="mb-3">
            <label for="kategori_artikel_id" class="form-label">Kategori</label>
            <select class="form-select" id="kategori_artikel_id" name="kategori_artikel_id" required></select>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        <button type="button" class="btn btn-primary" id="saveArtikelBtn">Simpan</button>
      </div>
    </div>
  </div>
</div>
