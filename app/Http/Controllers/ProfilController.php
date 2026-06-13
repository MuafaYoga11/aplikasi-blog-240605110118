<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Models\Penulis;

class ProfilController extends Controller
{
    public function partial()
    {
        $user = Auth::user();
        return view('partials.profil', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'nama_depan'    => 'required|string|max:100',
            'nama_belakang' => 'required|string|max:100',
            'user_name'     => 'required|string|max:50|unique:penulis,user_name,' . $user->id,
            'password'      => 'nullable|string|min:4',
            'foto'          => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = [
            'nama_depan'    => $request->nama_depan,
            'nama_belakang' => $request->nama_belakang,
            'user_name'     => $request->user_name,
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $namaFoto = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('uploads_penulis', $namaFoto, 'public');
            
            if ($user->foto && $user->foto !== 'default.png') {
                Storage::disk('public')->delete('uploads_penulis/' . $user->foto);
            }
            
            $data['foto'] = $namaFoto;
        }

        Penulis::where('id', $user->id)->update($data);

        return response()->json(['success' => true, 'message' => 'Profil berhasil diperbarui.']);
    }
}
