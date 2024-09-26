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
    public function __construct($data)
    {
        $this->data = $data;
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
        ]);
    }
}
