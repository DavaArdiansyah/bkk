<?php

namespace App\Http\Requests\DataAlumni;

use Illuminate\Foundation\Http\FormRequest;

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
            'nik' => ['required', 'digits:10', 'unique:data_alumni,nik,' . $this->route('alumni')->nik . ',nik'],
            'nama' => ['required', 'string', 'max:255'],
            'jenis-kelamin' => ['required', 'in:Laki Laki,Perempuan'],
            'jurusan' => ['required'],
            'tahun-lulus' => ['required', 'digits:4'],
        ];
    }

    public function messages(): array
    {
        return [
            'nik.required' => 'NIK wajib diisi.',
            'nik.digits' => 'NIK harus terdiri dari 16 angka.',
            'nik.unique' => 'NIK sudah ada.',
            'nama.required' => 'Nama wajib diisi.',
            'jenis-kelamin.required' => 'Jenis kelamin wajib diisi.',
            'jenis-kelamin.in' => 'Jenis kelamin tidak valid.',
            'jurusan.required' => 'Jurusan wajib diisi.',
            'tahun-lulus.required' => 'Tahun lulus wajib diisi.',
            'tahun-lulus.digits' => 'Tahun lulus harus terdiri dari 4 angka.',
        ];
    }
}
