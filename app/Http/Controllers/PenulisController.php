<?php

namespace App\Http\Controllers;

use App\Models\Penulis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class PenulisController extends Controller
{
    /**
     * Display the penulis management page.
     */
    public function index(Request $request)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $data = Penulis::all();
            return response()->json($data);
        }
        return view('dashboard');
    }

    /**
     * Return the partial view for AJAX sidebar navigation.
     */
    public function partial()
    {
        return view('partials.kelola_penulis');
    }

    /**
     * Store a newly created penulis.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_depan'    => 'required|string|max:100',
            'nama_belakang' => 'required|string|max:100',
            'user_name'     => 'required|string|max:50|unique:penulis,user_name',
            'password'      => 'required|string|min:4',
            'foto'          => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $namaFoto = 'default.png';

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $namaFoto = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('uploads_penulis', $namaFoto, 'public');
        }

        Penulis::create([
            'nama_depan'    => $request->nama_depan,
            'nama_belakang' => $request->nama_belakang,
            'user_name'     => $request->user_name,
            'password'      => Hash::make($request->password),
            'foto'          => $namaFoto,
        ]);

        return response()->json(['success' => true, 'message' => 'Data penulis berhasil disimpan.']);
    }

    /**
     * Show a single penulis (JSON for edit modal).
     */
    public function show(string $id)
    {
        $penulis = Penulis::findOrFail($id);
        return response()->json($penulis);
    }

    /**
     * Update the specified penulis.
     */
    public function update(Request $request, string $id)
    {
        $penulis = Penulis::findOrFail($id);

        $request->validate([
            'nama_depan'    => 'required|string|max:100',
            'nama_belakang' => 'required|string|max:100',
            'user_name'     => 'required|string|max:50|unique:penulis,user_name,' . $id,
            'password'      => 'nullable|string|min:4',
            'foto'          => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $penulis->nama_depan    = $request->nama_depan;
        $penulis->nama_belakang = $request->nama_belakang;
        $penulis->user_name     = $request->user_name;

        if ($request->filled('password')) {
            $penulis->password = Hash::make($request->password);
        }

        if ($request->hasFile('foto')) {
            // Delete old photo if not default
            if ($penulis->foto && $penulis->foto !== 'default.png') {
                Storage::disk('public')->delete('uploads_penulis/' . $penulis->foto);
            }
            $file = $request->file('foto');
            $namaFoto = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('uploads_penulis', $namaFoto, 'public');
            $penulis->foto = $namaFoto;
        }

        $penulis->save();

        return response()->json(['success' => true, 'message' => 'Data penulis berhasil diperbarui.']);
    }

    /**
     * Remove the specified penulis.
     * Block deletion if related articles exist.
     */
    public function destroy(string $id)
    {
        $penulis = Penulis::findOrFail($id);

        if ($penulis->artikel()->exists()) {
            return response()->json([
                'success' => false,
                'message' => 'Penulis masih memiliki artikel dan tidak dapat dihapus.'
            ], 422);
        }

        // Delete photo if not default
        if ($penulis->foto && $penulis->foto !== 'default.png') {
            Storage::disk('public')->delete('uploads_penulis/' . $penulis->foto);
        }

        $penulis->delete();

        return response()->json(['success' => true, 'message' => 'Data penulis berhasil dihapus.']);
    }
}
