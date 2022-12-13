<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class ProdukRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        $rules = [
            'kategori' => 'required',
            'nama' => 'required|unique:produk,nama,' . $this->id,
            'harga' => 'required',
            'pemasok' => 'required',
            'satuan' => 'required',
        ];

        if (!Request::instance()->has('id')) {
            $rules += [
                'status' => 'nullable',
                'gambar' => 'required|image|mimes:jpeg,png,jpg|max:2048'
            ];
        } else {
            $rules += [
                'status' => 'required',
                'gambar' => 'image|mimes:jpeg,png,jpg|max:2048'
            ];
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'required' => ':attribute tidak boleh kosong',
            'max' => ':attribute maksimal :max karakter',
            'mimes' => ':attribute harus berupa file :values',
            'image' => ':attribute harus berupa file gambar',
            'unique' => 'Data :attribute sudah ada'
        ];
    }

    public function attributes()
    {
        $attr = [
            'kategori' => 'Kategori',
            'nama' => 'Nama Produk',
            'harga' => 'Harga Produk',
            'pemasok' => 'Pemasok',
            'satuan' => 'Satuan produk',
            'gambar' => 'Gambar produk',
            'status' => 'Status'
        ];

        return $attr;
    }
}
