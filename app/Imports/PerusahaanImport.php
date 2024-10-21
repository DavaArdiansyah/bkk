<?php

namespace App\Imports;

use App\Models\Perusahaan;
use App\Models\User;
use Illuminate\Console\OutputStyle;
use Illuminate\Support\Facades\Hash;
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
        $perusahaan = Perusahaan::create([
            'nama' => $row['nama_perusahaan'],
            'bidang_usaha' => $row['bidang_usaha'],
            'no_telepon' => $row['no_telepon'],
        ]);

        return new User([
            'username' => $row['email'],
            'password' => Hash::make(env('DEFAULT_PASSWORD')),
            'role' => 'Perusahaan',
            'id_data_perusahaan' => $perusahaan->id_data_perusahaan,
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
        ];
    }

    public function withOutput(OutputStyle $output)
    {
        $output->progressStart(100);
        $output->progressAdvance();
        $output->progressFinish();
    }
}
