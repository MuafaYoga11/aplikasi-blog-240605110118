<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Artikel;
use App\Models\KategoriArtikel;

class PengunjungController extends Controller
{
    public function beranda(Request $request)
    {
        $kategoriId = $request->query('kategori');

        // Get all categories with article count
        $kategoriList = KategoriArtikel::withCount('artikel')->get();

        // Query articles
        $query = Artikel::with(['penulis', 'kategori'])
            ->orderBy('created_at', 'desc');

        if ($kategoriId) {
            $query->where('id_kategori', $kategoriId);
        }

        // Paginate results (5 per page)
        $artikel = $query->paginate(5)->withQueryString();

        return view('pengunjung.beranda', compact('artikel', 'kategoriList', 'kategoriId'));
    }

    public function detail($id)
    {
        $artikel = Artikel::with(['penulis', 'kategori'])->findOrFail($id);
        
        // Get related articles from the same category (excluding current)
        $artikelTerkait = Artikel::where('id_kategori', $artikel->id_kategori)
            ->where('id', '!=', $artikel->id)
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        return view('pengunjung.detail', compact('artikel', 'artikelTerkait'));
    }
}
