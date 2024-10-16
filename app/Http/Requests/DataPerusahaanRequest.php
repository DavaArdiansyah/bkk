<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DataPerusahaanRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function rules(): array
    {
        return [
            'nama' => ['required', 'string', 'max:255'],
            'bidang-usaha' => ['required', 'string', 'max:255'],
            'no-telepon' => ['required', 'numeric'],
            'file' => ['required', 'string'],
            'alamat-lengkap' => ['required', 'string', 'min:10', 'max:255'],
            'provinsi' => ['required'],
            'kota' => ['required'],
            'kecamatan' => ['required'],
            'kelurahan' => ['required'],
        ];
    }

    /**
     * Pesan kesalahan kustom untuk validasi.
     */
    public function messages(): array
    {
        return [
            'nama.required' => 'Nama harus diisi.',
            'nama.string' => 'Nama harus berupa teks.',
            'nama.max' => 'Nama tidak boleh lebih dari 255 karakter.',
            'bidang-usaha.required' => 'Bidang usaha harus diisi.',
            'bidang-usaha.string' => 'Bidang usaha harus berupa teks.',
            'bidang-usaha.max' => 'Bidang usaha tidak boleh lebih dari 255 karakter.',
            'no-telepon.required' => 'Nomor telepon harus diisi.',
            'no-telepon.numeric' => 'Nomor telepon harus berupa angka.',
            'file.required' => 'File harus diunggah.',
            'alamat-lengkap.required' => 'Alamat lengkap wajib diisi.',
            'alamat-lengkap.string' => 'Alamat lengkap harus berupa teks.',
            'alamat-lengkap.min' => 'Alamat lengkap harus memiliki minimal 10 karakter.',
            'alamat-lengkap.max' => 'Alamat lengkap melebihi batas karakter.',
            'provinsi.required' => 'Provinsi wajib diisi.',
            'kota.required' => 'Kota wajib diisi.',
            'kecamatan.required' => 'Kecamatan wajib diisi.',
            'kelurahan.required' => 'Kelurahan wajib diisi.',
        ];
    }
}
