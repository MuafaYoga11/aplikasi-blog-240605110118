<?php

namespace App\Http\Controllers;

use App\Models\KategoriArtikel;
use Illuminate\Http\Request;

class KategoriArtikelController extends Controller
{
    /**
     * Display listing or return JSON for AJAX.
     */
    public function index(Request $request)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $data = KategoriArtikel::all();
            return response()->json($data);
        }
        return view('dashboard');
    }

    /**
     * Return the partial view for AJAX sidebar navigation.
     */
    public function partial()
    {
        return view('partials.kelola_kategori');
    }

    /**
     * Store a newly created kategori.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_kategori' => 'required|string|max:100|unique:kategori_artikel,nama_kategori',
            'keterangan'    => 'nullable|string',
        ]);

        KategoriArtikel::create($validated);
        return response()->json(['success' => true, 'message' => 'Kategori berhasil disimpan.'], 201);
    }

    /**
     * Show a single kategori (JSON for edit modal).
     */
    public function show(string $id)
    {
        $kategori = KategoriArtikel::findOrFail($id);
        return response()->json($kategori);
    }

    /**
     * Update the specified kategori.
     */
    public function update(Request $request, string $id)
    {
        $kategori = KategoriArtikel::findOrFail($id);

        $validated = $request->validate([
            'nama_kategori' => 'required|string|max:100|unique:kategori_artikel,nama_kategori,' . $id,
            'keterangan'    => 'nullable|string',
        ]);

        $kategori->update($validated);
        return response()->json(['success' => true, 'message' => 'Kategori berhasil diperbarui.']);
    }

    /**
     * Remove the specified kategori.
     * Block deletion if related articles exist.
     */
    public function destroy(string $id)
    {
        $kategori = KategoriArtikel::findOrFail($id);

        if ($kategori->artikel()->exists()) {
            return response()->json([
                'success' => false,
                'message' => 'Kategori masih digunakan oleh artikel dan tidak dapat dihapus.'
            ], 422);
        }

        $kategori->delete();
        return response()->json(['success' => true, 'message' => 'Kategori berhasil dihapus.']);
    }
}
