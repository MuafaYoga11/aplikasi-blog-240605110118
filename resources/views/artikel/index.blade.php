@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Kelola Artikel</h2>
    <button class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#artikelModal" id="addArtikelBtn">Tambah Artikel</button>
    <table class="table table-striped" id="artikelTable">
        <thead>
            <tr>
                <th>ID</th>
                <th>Judul</th>
                <th>Penulis</th>
                <th>Kategori</th>
                <th>Tanggal</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>
</div>

@include('partials.artikel_modal')

<script type="module">
import { apiRequest, showToast } from '/resources/js/app.js';
const tbody = document.querySelector('#artikelTable tbody');
async function loadArtikel(){
    try {
        const data = await apiRequest('/api/artikel');
        tbody.innerHTML='';
        data.forEach(a=>{
            const row=document.createElement('tr');
            row.innerHTML=`
                <td>${a.id}</td>
                <td>${a.judul}</td>
                <td>${a.penulis?.nama_depan ?? ''} ${a.penulis?.nama_belakang ?? ''}</td>
                <td>${a.kategori_artikel?.nama_kategori ?? ''}</td>
                <td>${a.hari_tanggal}</td>
                <td>
                    <button class="btn btn-sm btn-primary me-1" onclick="editArtikel(${a.id})">Edit</button>
                    <button class="btn btn-sm btn-danger" onclick="deleteArtikel(${a.id})">Hapus</button>
                </td>`;
            tbody.appendChild(row);
        });
    } catch(e){showToast(e.message,'danger');}
}
window.editArtikel = async function(id){
    const artikel = (await apiRequest(`/api/artikel/${id}`)).data;
    document.getElementById('artikelId').value = artikel.id;
    document.getElementById('judul').value = artikel.judul;
    document.getElementById('isi').value = artikel.isi;
    document.getElementById('penulis_id').value = artikel.penulis_id;
    document.getElementById('kategori_artikel_id').value = artikel.kategori_artikel_id;
    new bootstrap.Modal(document.getElementById('artikelModal')).show();
};
window.deleteArtikel = async function(id){
    if(!confirm('Yakin hapus artikel?')) return;
    try{await apiRequest(`/api/artikel/${id}`,'DELETE');showToast('Berhasil dihapus');loadArtikel();}
    catch(e){showToast(e.message,'danger');}
};
document.getElementById('artikelForm').addEventListener('submit', async e=>{
    e.preventDefault();
    const fd=new FormData(e.target);
    const id=fd.get('id');
    const method=id?'PUT':'POST';
    const url=id?`/api/artikel/${id}`:'/api/artikel';
    // Convert FormData to plain object, handling file separately
    const payload={};
    fd.forEach((value,key)=>{payload[key]=value});
    try{await apiRequest(url,method,payload);showToast('Simpan berhasil');bootstrap.Modal.getInstance(document.getElementById('artikelModal')).hide();loadArtikel();}
    catch(e){showToast(e.message,'danger');}
});
loadArtikel();
</script>
@endsection
