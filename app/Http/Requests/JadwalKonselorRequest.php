<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class JadwalKonselorRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {

        return [
            'konselor_id' => 'required|exists:konselors,id',
            'hari_layanan_id' => 'required|exists:hari_layanans,id',
        ];
    }

    public function messages(): array
    {
        return [
            'konselor_id.required' => 'Konselor wajib diisi.',
            'konselor_id.exists' => 'Konselor tidak ditemukan.',
            'hari_layanan_id.required' => 'Hari layanan wajib diisi.',
            'hari_layanan_id.exists' => 'Hari layanan tidak ditemukan.',
        ];
    }
}
