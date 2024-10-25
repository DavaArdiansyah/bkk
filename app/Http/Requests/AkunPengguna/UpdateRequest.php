<?php

namespace App\Http\Requests\AkunPengguna;

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
    public function rules()
    {
        return [
            // 'username' => [
            //     'required',
            //     "unique:users,username," . $this->route('user')->username . ',username',
            //     function ($attribute, $value, $fail) {
            //         if (!filter_var($value, FILTER_VALIDATE_EMAIL) && !preg_match('/^[0-9]{16}$/', $value)) {
            //             $fail('Username harus berupa NIK (16 digit angka) atau alamat email yang valid.');
            //         }
            //     },
            // ],
            'password_baru' => ['nullable', 'min:8'],
            'konfirmasi-password' => ['nullable', 'required_with:password-baru', 'same:password-baru'],
        ];
    }

    public function messages()
    {
        return [
            // 'username.required' => 'Email wajib diisi.',
            // 'username.email' => 'Email tidak valid',
            // 'username.unique' => 'Email sudah ada.',
            'password_baru.min' => 'Password baru harus memiliki minimal 8 karakter.',
            'konfirmasi-password.required_with' => 'Konfirmasi password saat ini harus diisi jika Anda mengubah password.',
            'konfirmasi-password.same' => 'Konfirmasi password harus sama dengan password baru.',
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
