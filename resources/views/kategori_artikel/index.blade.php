@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Kelola Kategori Artikel</h2>
    <button class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#kategoriModal" id="addKategoriBtn">Tambah Kategori</button>
    <table class="table table-striped" id="kategoriTable">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama Kategori</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>
</div>

@include('partials.kategori_modal')

<script type="module">
import { apiRequest, showToast } from '/resources/js/app.js';
const tableBody = document.querySelector('#kategoriTable tbody');
async function loadKategori() {
    try {
        const data = await apiRequest('/api/kategori-artikel');
        tableBody.innerHTML = '';
        data.forEach(k => {
            const row = document.createElement('tr');
            row.innerHTML = `
                <td>${k.id}</td>
                <td>${k.nama_kategori}</td>
                <td>
                    <button class="btn btn-sm btn-primary me-1" onclick="editKategori(${k.id})">Edit</button>
                    <button class="btn btn-sm btn-danger" onclick="deleteKategori(${k.id})">Hapus</button>
                </td>`;
            tableBody.appendChild(row);
        });
    } catch (e) { showToast(e.message, 'danger'); }
}
window.editKategori = async function(id) {
    const kategori = (await apiRequest(`/api/kategori-artikel/${id}`)).data;
    document.getElementById('kategoriId').value = kategori.id;
    document.getElementById('namaKategori').value = kategori.nama_kategori;
    new bootstrap.Modal(document.getElementById('kategoriModal')).show();
};
window.deleteKategori = async function(id) {
    if (!confirm('Yakin hapus kategori?')) return;
    try { await apiRequest(`/api/kategori-artikel/${id}`, 'DELETE'); showToast('Berhasil dihapus'); loadKategori(); }
    catch (e) { showToast(e.message, 'danger'); }
};
document.getElementById('kategoriForm').addEventListener('submit', async e => {
    e.preventDefault();
    const fd = new FormData(e.target);
    const id = fd.get('id');
    const method = id ? 'PUT' : 'POST';
    const url = id ? `/api/kategori-artikel/${id}` : '/api/kategori-artikel';
    try { await apiRequest(url, method, Object.fromEntries(fd)); showToast('Simpan berhasil'); bootstrap.Modal.getInstance(document.getElementById('kategoriModal')).hide(); loadKategori(); }
    catch (e) { showToast(e.message, 'danger'); }
});
loadKategori();
</script>
@endsection
