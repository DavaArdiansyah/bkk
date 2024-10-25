<?php

namespace App\View\Components\Card;

use App\Models\Lamaran;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\Component;

class Lowongan extends Component
{
    /**
     * Create a new component instance.
     */
    public $data;
    public $lamaran;
    public function __construct($data)
    {
        $this->data = $data;
        $this->lamaran = Lamaran::where('nik', Auth::user()->alumni->nik)->where('id_lowongan_pekerjaan', $this->data->id_lowongan_pekerjaan)->whereIn('status', ['Terkirim', 'Lolos Ketahap Selanjutnya'])->orderby('waktu', 'desc')->first();
        if ($this->lamaran) {
            $fileName = 'public/files/' . $this->lamaran->id_lamaran . $this->lamaran->alumni->nama . '.txt';
            $this->lamaran['pesan'] = Storage::exists($fileName) ? Storage::get($fileName) : 'Pesan Tidak Ditemukan.';
        }
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.card.lowongan', [
            'data' => $this->data,
            'lamaran' => $this->lamaran,
        ]);
    }
}
