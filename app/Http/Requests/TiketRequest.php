<?php

namespace App\Http\Requests;

use App\Models\Tikets;
use Illuminate\Foundation\Http\FormRequest;

class TiketRequest extends FormRequest
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

        if ($this->isMethod('post')) {
            return [
                'konseli_id' => 'required|exists:konselis,id',
                'konselor_id' => 'required|exists:konselors,id',
                'hari_layanan_id' => 'required|exists:hari_layanans,id',
                'deskripsi_keluhan' => 'required|string',
            ];
        }

        if ($this->isMethod('put') || $this->isMethod('patch')) {
            return [
                'konseli_id' => 'sometimes|required|exists:konselis,id',
                'konselor_id' => 'sometimes|required|exists:konselors,id',
                'hari_layanan_id' => 'sometimes|required|exists:hari_layanans,id',
                'deskripsi_keluhan' => 'sometimes|required|string',
                'status' => 'sometimes|required|in:pending,approved,rejected',
                'urgensi' => 'sometimes|required|in:mendesak,cukup_mendesak,tidak_mendesak',
            ];
        }

        return [];
    }

    public function messages(): array
    {
        return [
            'konseli_id.required' => 'ID konseli wajib diisi.',
            'konseli_id.exists' => 'ID konseli tidak ditemukan.',
            'konselor_id.required' => 'ID konselor wajib diisi.',
            'konselor_id.exists' => 'ID konselor tidak ditemukan.',
            'hari_layanan_id.required' => 'ID hari layanan wajib diisi.',
            'hari_layanan_id.exists' => 'ID hari layanan tidak ditemukan.',
            'deskripsi_keluhan.required' => 'Deskripsi keluhan wajib diisi.',
            'deskripsi_keluhan.string' => 'Deskripsi keluhan harus berupa string.',
            'status.required' => 'Status wajib diisi.',
            'status.in' => 'Status harus salah satu dari: pending, approved, rejected.',
            'urgensi.required' => 'Urgensi wajib diisi.',
            'urgensi.in' => 'Urgensi harus salah satu dari: mendesak, cukup_mendesak, tidak_mendesak.',
        ];
    }
}
