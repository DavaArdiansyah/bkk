<?php

namespace App\Exports;

use App\Models\DataAlumni;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;

class detailALumniBekerjaExport implements FromArray, WithHeadings
{
    protected $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function array(): array
    {
        return $this->data;
    }

    public function headings(): array
    {
        return [
            'NIK',
            'Nama Lengkap',
            'Nama Perusahaan',
        ];
    }
}
