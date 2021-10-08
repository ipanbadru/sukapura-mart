<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PelangganRequest extends FormRequest
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
            'nik' => ['required', 'numeric', Rule::unique('pelanggan')->ignore($this->pelanggan)],
            'nama_pelanggan' => ['required', 'string', 'max:255'],
            'no_hp' => ['required', 'numeric', Rule::unique('pelanggan')->ignore($this->pelanggan)]
        ];
    }
}
