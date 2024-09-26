<?php

namespace App\Imports;

use App\Models\Perusahaan;
use App\Models\User;
use Illuminate\Console\OutputStyle;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithProgressBar;
use Maatwebsite\Excel\Concerns\WithValidation;

class PerusahaanImport implements ToModel, WithValidation, WithHeadingRow, WithProgressBar
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
            'username' => $row['email'],
            'password' => $row['password'],
            'role' => 'Perusahaan',
        ]);

        return new Perusahaan([
            'username' => $user->username,
            'nama' => $row['nama_perusahaan'],
            'bidang_usaha' => $row['bidang_usaha'],
            'no_telepon' => $row['no_telepon'],
            'alamat' => $row['alamat'],
        ]);
    }

    public function rules(): array
    {
        return [
            'email' => ['required', 'unique:users,username'],
            'nama_perusahaan' => ['required'],
            'bidang_usaha' => ['required'],
            'alamat' => ['required'],
            'no_telepon' => ['required'],
            'password' => ['required']
        ];
    }

    public function withOutput(OutputStyle $output)
    {
        $output->progressStart(100);
        $output->progressAdvance();
        $output->progressFinish();
    }
}
