<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class BarangRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'kode_barang' => ['required', 'alpha_num', Rule::unique('barang')->ignore($this->barang)],
            'nama_barang' => ['required', 'string'],
            'harga_beli' => ['required'],
            'harga_jual' => ['required'],
            'jumlah_barang' => ['required', 'numeric'],
        ];
    }
}
