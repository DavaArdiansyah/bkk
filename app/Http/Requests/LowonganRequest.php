<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LowonganRequest extends FormRequest
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
            'jenis-waktu-pekerjaan' => ['required', 'string'],
            'tanggal-akhir' => ['required', 'regex:/^\d{1,2}\s(January|February|March|April|May|June|July|August|September|October|November|December)\s\d{4}\s\d{2}:\d{2}$/'],
            'deskripsi' => ['required', 'string'],
        ];
    }

    public function messages()
    {
        return [
            'jabatan.required' => 'Jabatan wajib diisi.',
            'jabatan.string' => 'Jabatan harus berupa teks.',
            'jabatan.max' => 'Jabatan tidak boleh lebih dari 255 karakter.',
            'jenis-waktu-pekerjaan.required' => 'Jenis waktu pekerjaan wajib diisi.',
            'jenis-waktu-pekerjaan.string' => 'Jenis waktu pekerjaan harus berupa teks.',
            'tanggal-akhir.required' => 'Tanggal akhir wajib diisi.',
            'tanggal-akhir.regex' => 'Format tanggal akhir tidak valid. Format yang benar adalah: 1 January 2024.',
            'deskripsi.required' => 'Deskripsi lowongan wajib diisi.',
            'deskripsi.string' => 'Deskripsi lowongan harus berupa teks.',
        ];
    }
}
