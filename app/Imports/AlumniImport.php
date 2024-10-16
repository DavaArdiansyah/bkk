<?php

namespace App\Imports;

use App\Models\Alumni;
use App\Models\User;
use Illuminate\Console\OutputStyle;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithProgressBar;
use Maatwebsite\Excel\Concerns\WithValidation;

class AlumniImport implements ToModel, WithValidation, WithHeadingRow, WithProgressBar
{
    use Importable;
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $user = User::create([
            'username' => $row['nik'],
            'password' => Hash::make('bursakerja'),
            'role' => 'Alumni',
        ]);
        return new Alumni([
            'nik' => $row['nik'],
            'username' => $user->username,
            'nama' => $row['nama_lengkap'],
            'jurusan' => $row['jurusan'],
            'jenis_kelamin' => $row['jenis_kelamin'],
            'tahun_lulus' => $row['tahun_lulus']
        ]);
    }

    public function rules(): array
    {
        return [
            'nik' => ['required', 'unique:data_alumni,nik'],
            'nama_lengkap' => ['required'],
            'jenis_kelamin' => ['required', 'in:Laki Laki,Perempuan'],
            'jurusan' => ['required', 'in:AK,BR,DKV,MLOG,MP,RPL,TKJ'],
            'tahun_lulus' => ['required'],
        ];
    }

    // public function messages()
    // {
    //     return [
    //         'nik.required' => 'Kolom NIK wajib diisi.',
    //         'nik.unique' => 'Value NIK sudah ada.',
    //         'nama_lengkap.required' => 'Kolom Nama Lengkap wajib diisi.',
    //         'jenis_kelamin.required' => 'Kolom Jenis Kelamin wajib diisi.',
    //         'jenis_kelamin.in' => 'Value Jenis Kelamin tidak valid.',
    //         'jurusan.required' => 'Kolom Jurusan wajib diisi.',
    //         'jurusan.in' => 'Value Jurusan tidak valid.',
    //         'tahun_lulus.required' => 'Kolom Tahun Lulus wajib diisi.',
    //     ];
    // }

    public function withOutput(OutputStyle $output)
    {
        $output->progressStart(100);
        $output->progressAdvance();
        $output->progressFinish();
    }
}
