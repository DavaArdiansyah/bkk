<?php

namespace App\Http\Requests\AkunPengguna;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Http;

class AkunAdminRequest extends FormRequest
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
            'username' => ['required', 'email', 'unique:users,username'],
            'password' => ['required', 'min:8'],
            'file' => 'required',
            'nip' => ['required', 'numeric', 'digits:18'],
            'nama' => ['required', 'string', 'max:255'],
            'jenis-kelamin' => ['required', 'in:Laki Laki,Perempuan'],
            'kontak' => ['required', 'numeric', 'digits_between:10,13'],
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
            'username.required' => 'Email wajib diisi.',
            'username.email' => 'Email tidak valid.',
            'username.unique' => 'Email sudah ada.',
            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password harus memiliki minimal 8 karakter.',
            'file.required' => 'Logo Perusahaan wajib diisi.',
            'nip.required' => 'NIP wajib diisi.',
            'nip.numeric' => 'NIP harus berupa angka.',
            'nip.digits' => 'NIP terdiri dari 18 digit angka.',
            'nama.required' => 'Nama Admin BKK wajib diisi.',
            'jenis-kelamin.required' => 'Jenis Kelamin wajib diisi.',
            'jenis-kelamin.in' => 'Jenis kelamin tidak valid.',
            'kontak.required' => 'Kontak yang dapat dihubungi wajib diisi.',
            'kontak.numeric' => 'Kontak yang dapat dihubungi harus berupa angka.',
            'kontak.digits_between' => 'Nomor kontak harus terdiri dari 10 hingga 13 digit angka.',
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

    // public function withValidator($validator)
    // {
    //     $validator->after(function ($validator) {
    //         $username = $this->input('username');

    //         if (filter_var($username, FILTER_VALIDATE_EMAIL)) {
    //             $hunter_api_key = env('HUNTER_API_KEY');
    //             $response = Http::get("https://api.hunter.io/v2/email-verifier", [
    //                 'email' => $username,
    //                 'api_key' => $hunter_api_key,
    //             ]);

    //             $status = $response->json()['data']['status'];

    //             if ($status == 'invalid') {
    //                 $validator->errors()->add('username', 'Email tidak valid.');
    //             }
    //         }
    //     });
    // }
}
