<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class KeahlianRequest extends FormRequest
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
            'keahlian' => ['required', 'string'],
        ];
    }

    public function messages()
    {
        return [
            'keahlian.required' => 'Keahlian wajib diisi.',
            'keahlian.string' => 'Keahlian harus berupa teks.',
        ];
    }
}
