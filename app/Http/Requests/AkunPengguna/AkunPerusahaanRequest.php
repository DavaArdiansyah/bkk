<?php

namespace App\Http\Requests\AkunPengguna;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Http;

class AkunPerusahaanRequest extends FormRequest
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
            'konfirmasi-password' => ['nullable', 'required_with:password', 'same:password'],
            'id-data-perusahaan' => ['required', 'exists:data_perusahaan,id_data_perusahaan'],
        ];
    }

    public function messages(): array
    {
        return [
            'username.required' => 'Email wajib diisi.',
            'username.email' => 'Email tidak valid.',
            'username.unique' => 'Email sudah ada.',
            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password harus memiliki minimal 8 karakter.',
            'konfirmasi-password.required_with' => 'Konfirmasi password wajib diisi.',
            'konfirmasi-password.same' => 'Konfirmasi password harus sama dengan password.',
            'id-data-perusahaan.required' => 'Nama Perusahaan wajib diisi.',
            'id-data-perusahaan.exists' => 'Nama Perusahaan tidak ada pada database kami.',
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
