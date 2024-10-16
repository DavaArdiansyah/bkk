<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PendidikanFormalRequest extends FormRequest
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
            'nama-sekolah' => ['required', 'string', 'max:255'],
            'alamat-lengkap' => ['required', 'string', 'min:10', 'max:255'],
            'provinsi' => ['required'],
            'kota' => ['required'],
            'kecamatan' => ['required'],
            'kelurahan' => ['required'],
            'gelar' => ['nullable', 'string', 'max:50'],
            'bidang-studi' => ['nullable', 'string', 'max:255'],
            'tahun-awal' => ['required', 'digits:4'],
            'tahun-akhir' => ['required', 'digits:4'],
            'deskripsi' => ['required', 'string'],
        ];
    }

    public function messages()
    {
        return [
            'nama-sekolah.required' => 'Nama sekolah atau universitas harus diisi.',
            'nama-sekolah.string' => 'Nama sekolah atau universitas harus berupa teks.',
            'nama-sekolah.max' => 'Nama sekolah atau universitas tidak boleh lebih dari 255 karakter.',
            'alamat-lengkap.required' => 'Alamat lengkap wajib diisi.',
            'alamat-lengkap.string' => 'Alamat lengkap harus berupa teks.',
            'alamat-lengkap.min' => 'Alamat lengkap harus memiliki minimal 10 karakter.',
            'alamat-lengkap.max' => 'Alamat lengkap melebihi batas karakter.',
            'provinsi.required' => 'Provinsi wajib diisi.',
            'kota.required' => 'Kota wajib diisi.',
            'kecamatan.required' => 'Kecamatan wajib diisi.',
            'kelurahan.required' => 'Kelurahan wajib diisi.',
            'gelar.required' => 'Gelar harus diisi.',
            'gelar.string' => 'Gelar harus berupa teks.',
            'gelar.max' => 'Gelar tidak boleh lebih dari 50 karakter.',
            'bidang-studi.required' => 'Bidang studi harus diisi.',
            'bidang-studi.string' => 'Bidang studi harus berupa teks.',
            'bidang-studi.max' => 'Bidang studi tidak boleh lebih dari 255 karakter.',
            'tahun-awal.required' => 'Tahun awal wajib diisi.',
            'tahun-awal.digits' => 'Tahun awal harus terdiri dari 4 angka.',
            'tahun-akhir.required' => 'Tahun akhir wajib diisi.',
            'tahun-akhir.digits' => 'Tahun akhir harus terdiri dari 4 angka.',
            'deskripsi.required' => 'Deskripsi wajib diisi.',
            'deskripsi.string' => 'Deskripsi harus berupa teks.',
        ];
    }
}
