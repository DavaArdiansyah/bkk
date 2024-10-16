<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PengalamanKerjaRequest extends FormRequest
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
            'jabatan' => ['required', 'string', 'max:255'],
            'nama-perusahaan' => ['required', 'string', 'max:255'],
            'jenis-waktu-pekerjaan' => ['required', 'string'],
            'alamat-lengkap' => ['required', 'string', 'min:10', 'max:255'],
            'provinsi' => ['required'],
            'kota' => ['required'],
            'kecamatan' => ['required'],
            'kelurahan' => ['required'],
            'tahun-awal' => ['required', 'digits:4'],
            'tahun-akhir' => ['required', 'digits:4'],
            'deskripsi' => ['required', 'string'],
        ];
    }

    public function messages()
    {
        return [
            'jabatan.required' => 'Jabatan wajib diisi.',
            'jabatan.string' => 'Jabatan harus berupa teks.',
            'jabatan.max' => 'Jabatan tidak boleh lebih dari 255 karakter.',
            'nama-perusahaan.required' => 'Nama harus diisi.',
            'nama-perusahaan.string' => 'Nama harus berupa teks.',
            'nama-perusahaan.max' => 'Nama tidak boleh lebih dari 255 karakter.',
            'jenis-waktu-pekerjaan.required' => 'Jenis waktu pekerjaan wajib diisi.',
            'jenis-waktu-pekerjaan.string' => 'Jenis waktu pekerjaan harus berupa teks.',
            'alamat-lengkap.required' => 'Alamat lengkap wajib diisi.',
            'alamat-lengkap.string' => 'Alamat lengkap harus berupa teks.',
            'alamat-lengkap.min' => 'Alamat lengkap harus memiliki minimal 10 karakter.',
            'alamat-lengkap.max' => 'Alamat lengkap melebihi batas karakter.',
            'provinsi.required' => 'Provinsi wajib diisi.',
            'kota.required' => 'Kota wajib diisi.',
            'kecamatan.required' => 'Kecamatan wajib diisi.',
            'kelurahan.required' => 'Kelurahan wajib diisi.',
            'tahun-awal.required' => 'Tahun awal wajib diisi.',
            'tahun-awal.digits' => 'Tahun awal harus terdiri dari 4 angka.',
            'tahun-akhir.required' => 'Tahun akhir wajib diisi.',
            'tahun-akhir.digits' => 'Tahun akhir harus terdiri dari 4 angka.',
            'deskripsi.required' => 'Deskripsi wajib diisi.',
            'deskripsi.string' => 'Deskripsi harus berupa teks.',
        ];
    }
}
