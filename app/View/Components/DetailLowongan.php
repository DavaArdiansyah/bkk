<?php

namespace App\View\Components;

use App\Models\Lamaran;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;

class DetailLowongan extends Component
{
    /**
     * Create a new component instance.
     */
    public $data;
    public $pelamar;
    public $diterima;
    public $ditolak;
    public $status;
    public function __construct($data)
    {
        $this->data = $data;
        $this->status = Lamaran::where('nik', Auth::user()->alumni->nik)->where('id_lowongan_pekerjaan', $this->data->id_lowongan_pekerjaan)->whereIn('status', ['Terkirim', 'Lolos Ketahap Selanjutnya'])->orderby('waktu', 'desc')->first();
        if (Auth::user()->role == 'Admin BKK') {
            $this->pelamar = Lamaran::where('id_lowongan_pekerjaan', $data->id_lowongan_pekerjaan)->count();
            $this->diterima = Lamaran::where('id_lowongan_pekerjaan', $data->id_lowongan_pekerjaan)->where('status', 'Diterima')->count();
            $this->ditolak = Lamaran::where('id_lowongan_pekerjaan', $data->id_lowongan_pekerjaan)->where('status', 'Ditolak')->count();
        }
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.detail-lowongan', [
            'data' => $this->data,
            'status' => $this->status,
        ]);
    }
}
