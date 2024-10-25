<?php

namespace App\View\Components\Modal;

use App\Models\Lamaran;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;

class Cv extends Component
{
    /**
     * Create a new component instance.
     */
    public $id;
    public $lamaran;
    public function __construct($id)
    {
        $this->id = $id;
        $this->lamaran = Lamaran::where('nik', Auth::user()->alumni->nik)->where('id_lowongan_pekerjaan', $this->id)->whereIn('status', ['Terkirim', 'Lolos Ketahap Selanjutnya'])->orderby('waktu', 'desc')->first();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.modal.cv', [
            'lamaran' => $this->lamaran
        ]);
    }
}
