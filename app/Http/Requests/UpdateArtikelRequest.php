<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateArtikelRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize()
    {
        return true; // Public API
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules()
    {
        return [
            'id_penulis'   => 'sometimes|required|exists:penulis,id',
            'id_kategori'  => 'sometimes|required|exists:kategori_artikel,id',
            'judul'        => 'sometimes|required|string|max:255',
            'isi'          => 'sometimes|required|string',
            'gambar'       => 'sometimes|nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ];
    }
}
?>
