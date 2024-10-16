<?php

namespace App\Http\Requests\DataPerusahaan;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Http;

class StoreRequest extends FormRequest
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
            'password' => ['required', 'string', 'min:8'],
        ];
    }

    /**
     * Pesan kesalahan kustom untuk validasi.
     */
    public function messages(): array
    {
        return [
            'username.required' => 'Email perusahaan wajib diisi.',
            'username.email' => 'Format email tidak valid.',
            'username.unique' => 'Email sudah ada.',
            'password.required' => 'Kata sandi wajib diisi.',
            'password.min' => 'Kata sandi harus minimal 8 karakter.',
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
