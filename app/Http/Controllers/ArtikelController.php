<?php

namespace App\Http\Controllers;

use App\Models\Artikel;
use App\Models\Penulis;
use App\Models\KategoriArtikel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class ArtikelController extends Controller
{
    /**
     * Display the artikel management page, or return JSON for AJAX.
     */
    public function index(Request $request)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $data = Artikel::with(['penulis', 'kategori'])->get();
            return response()->json($data);
        }
        return view('dashboard');
    }

    /**
     * Return the partial view for AJAX sidebar navigation.
     */
    public function partial()
    {
        $penulis  = Penulis::all();
        $kategori = KategoriArtikel::all();
        return view('partials.kelola_artikel', compact('penulis', 'kategori'));
    }

    /**
     * Store a new article.
     */
    public function store(Request $request)
    {
        $request->validate([
            'judul'       => 'required|string|max:255',
            'id_penulis'  => 'required|exists:penulis,id',
            'id_kategori' => 'required|exists:kategori_artikel,id',
            'isi'         => 'required|string',
            'gambar'      => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $namaGambar = '';
        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $namaGambar = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('uploads_artikel', $namaGambar, 'public');
        }

        // Set formatted date with Indonesian locale
        $hariTanggal = Carbon::now('Asia/Jakarta')
            ->locale('id')
            ->isoFormat('dddd, D MMMM YYYY | HH:mm');

        Artikel::create([
            'id_penulis'   => $request->id_penulis,
            'id_kategori'  => $request->id_kategori,
            'judul'        => $request->judul,
            'isi'          => $request->isi,
            'gambar'       => $namaGambar,
            'hari_tanggal' => $hariTanggal,
        ]);

        return response()->json(['success' => true, 'message' => 'Artikel berhasil disimpan.'], 201);
    }

    /**
     * Show a single article (JSON for edit modal).
     */
    public function show(string $id)
    {
        $artikel = Artikel::with(['penulis', 'kategori'])->findOrFail($id);
        return response()->json($artikel);
    }

    /**
     * Update an existing article.
     */
    public function update(Request $request, string $id)
    {
        $artikel = Artikel::findOrFail($id);

        $request->validate([
            'judul'       => 'required|string|max:255',
            'id_penulis'  => 'required|exists:penulis,id',
            'id_kategori' => 'required|exists:kategori_artikel,id',
            'isi'         => 'required|string',
            'gambar'      => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $artikel->judul       = $request->judul;
        $artikel->id_penulis  = $request->id_penulis;
        $artikel->id_kategori = $request->id_kategori;
        $artikel->isi         = $request->isi;

        if ($request->hasFile('gambar')) {
            // Delete old image
            if ($artikel->gambar) {
                Storage::disk('public')->delete('uploads_artikel/' . $artikel->gambar);
            }
            $file = $request->file('gambar');
            $namaGambar = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('uploads_artikel', $namaGambar, 'public');
            $artikel->gambar = $namaGambar;
        }

        $artikel->save();

        return response()->json(['success' => true, 'message' => 'Artikel berhasil diperbarui.']);
    }

    /**
     * Delete an article and its image.
     */
    public function destroy(string $id)
    {
        $artikel = Artikel::findOrFail($id);

        if ($artikel->gambar) {
            Storage::disk('public')->delete('uploads_artikel/' . $artikel->gambar);
        }

        $artikel->delete();

        return response()->json(['success' => true, 'message' => 'Artikel berhasil dihapus.']);
    }
}
