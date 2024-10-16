<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PendidikanNonFormalRequest extends FormRequest
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
            'nama-lembaga' => ['required', 'string', 'max:255'],
            'alamat-lengkap' => ['required', 'string', 'min:10', 'max:255'],
            'provinsi' => ['required'],
            'kota' => ['required'],
            'kecamatan' => ['required'],
            'kelurahan' => ['required'],
            'nama-kursus' => ['required', 'string', 'max:255'],
            'tanggal' => ['required', 'regex:/^\d{1,2}\s(January|February|March|April|May|June|July|August|September|October|November|December)\s\d{4}$/'],
        ];
    }

    public function messages()
    {
        return [
            'nama-lembaga.required' => 'Nama lambaga harus diisi.',
            'nama-lembaga.string' => 'Nama lambaga harus berupa teks.',
            'nama-lembaga.max' => 'Nama lambaga tidak boleh lebih dari 255 karakter.',
            'alamat-lengkap.required' => 'Alamat lengkap wajib diisi.',
            'alamat-lengkap.string' => 'Alamat lengkap harus berupa teks.',
            'alamat-lengkap.min' => 'Alamat lengkap harus memiliki minimal 10 karakter.',
            'alamat-lengkap.max' => 'Alamat lengkap melebihi batas karakter.',
            'provinsi.required' => 'Provinsi wajib diisi.',
            'kota.required' => 'Kota wajib diisi.',
            'kecamatan.required' => 'Kecamatan wajib diisi.',
            'kelurahan.required' => 'Kelurahan wajib diisi.',
            'nama-kursus.required' => 'Nama kursus harus diisi.',
            'nama-kursus.string' => 'Nama kursus harus berupa teks.',
            'nama-kursus.max' => 'Nama kursus tidak boleh lebih dari 255 karakter.',
            'tanggal.required' => 'Tanggal harus diisi.',
            'tanggal.regex' => 'Format tanggal tidak valid. Harap gunakan format "DD Month YYYY" (contoh: 22 October 2024).',
        ];
    }
}
