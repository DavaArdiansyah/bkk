<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;

class LacakAlumniExport implements FromArray, WithHeadings
{
    protected $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function array(): array
    {
        return [
            ['Bekerja', $this->data['bekerja'] == 0 ? '0' : $this->data['bekerja']],
            ['Kuliah', $this->data['kuliah'] == 0 ? '0' : $this->data['kuliah']],
            ['Wirausaha', $this->data['wirausaha'] == 0 ? '0' : $this->data['wirausaha']],
            ['Tidak Bekerja', $this->data['tidak bekerja'] == 0 ? '0' : $this->data['tidak bekerja']],
        ];
    }

    public function headings(): array
    {
        return [
            'Status',
            'Jumlah Alumni',
        ];
    }
}
