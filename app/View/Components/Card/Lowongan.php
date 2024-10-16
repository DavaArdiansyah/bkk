<?php

namespace App\View\Components\Card;

use App\Models\Lamaran;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;

class Lowongan extends Component
{
    /**
     * Create a new component instance.
     */
    public $data;
    public $status;
    public function __construct($data)
    {
        $this->data = $data;
        $this->status = Lamaran::where('nik', Auth::user()->alumni->nik)->where('id_lowongan_pekerjaan', $this->data->id_lowongan_pekerjaan)->whereIn('status', ['Terkirim', 'Lolos Ketahap Selanjutnya'])->orderby('waktu', 'desc')->first();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.card.lowongan', [
            'data' => $this->data,
            'status' => $this->status,
        ]);
    }
}
