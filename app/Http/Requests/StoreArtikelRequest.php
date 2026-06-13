<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreArtikelRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize()
    {
        return true; // Public API, no auth required
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules()
    {
        return [
            'id_penulis'   => 'required|exists:penulis,id',
            'id_kategori'  => 'required|exists:kategori_artikel,id',
            'judul'        => 'required|string|max:255',
            'isi'          => 'required|string',
            'gambar'       => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ];
    }
}
?>
