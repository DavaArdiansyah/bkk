<?php

namespace App\Http\Requests\Profil;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Http;

class UpdateRequest extends FormRequest
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
            'username' => [
                'nullable',
                "unique:users,username," . $this->route('user')->username . ',username',
                function ($attribute, $value, $fail) {
                    if (!filter_var($value, FILTER_VALIDATE_EMAIL) && !preg_match('/^[0-9]{16}$/', $value)) {
                        $fail('Username harus berupa NIK (16 digit angka) atau alamat email yang valid.');
                    }
                },
            ],
            'password-baru' => ['nullable', 'min:8'],
            'konfirmasi-password' => ['nullable', 'required_with:password-baru', 'same:password-baru'],
            'password-saat-ini' => ['nullable', 'required_with:password-baru'],
            'file' => ['nullable', 'string'],
            'kontak' => ['nullable', 'numeric', 'digits_between:10,13'],
            'bidang-usaha' => ['nullable', 'string', 'max:255'],
            'no-telepon' => ['nullable', 'numeric'],
            'nama' => ['nullable', 'string', 'max:255'],
            'jenis-kelamin' => ['nullable', 'in:Laki Laki,Perempuan'],
            'alamat-lengkap' => ['required', 'string', 'min:10', 'max:255'],
            'provinsi' => ['required'],
            'kota' => ['required'],
            'kecamatan' => ['required'],
            'kelurahan' => ['required'],
        ];
    }

    public function messages()
    {
        return [
            'username.unique' => 'Username sudah ada.',
            'password-baru.min' => 'Password baru harus memiliki minimal 8 karakter.',
            'konfirmasi-password.required_with' => 'Konfirmasi password saat ini harus diisi jika Anda mengubah password.',
            'konfirmasi-password.same' => 'Konfirmasi password harus sama dengan password baru.',
            'password-saat-ini.required_with' => 'Password saat ini harus diisi jika Anda mengubah password.',
            'file.string' => 'Wajib mengunggah file yang valid.',
            'kontak.numeric' => 'Kontak yang dapat dihubungi harus berupa angka.',
            'kontak.digits-between' => 'Nomor kontak harus terdiri dari 10 hingga 13 digit angka.',
            'bidang-usaha.string' => 'Bidang usaha harus berupa string.',
            'bidang-usaha.max' => 'Bidang usaha tidak boleh lebih dari 255 karakter.',
            'no-telepon.numeric' => 'Nomor telepon harus berupa angka.',
            'nama.string' => 'Nama harus berupa string.',
            'nama.max' => 'Nama tidak boleh lebih dari 255 karakter.',
            'jenis-kelamin.in' => 'Jenis kelamin tidak valid.',
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
    //         $currentUsername = $this->route('user')->username;

    //         if ($username !== $currentUsername) {
    //             if (filter_var($username, FILTER_VALIDATE_EMAIL)) {
    //                 $hunter_api_key = env('HUNTER_API_KEY');
    //                 $response = Http::get("https://api.hunter.io/v2/email-verifier", [
    //                     'email' => $username,
    //                     'api_key' => $hunter_api_key,
    //                 ]);

    //                 $status = $response->json()['data']['status'];

    //                 if ($status == 'invalid') {
    //                     $validator->errors()->add('username', 'Email tidak valid.');
    //                 }
    //             }
    //         }
    //     });
    // }
}
