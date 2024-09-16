<?php

namespace App\View\Components;

use App\Models\Kerja;
use App\Models\PendidikanFormal;
use App\Models\PendidikanNonFormal;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class DetailAlumni extends Component
{
    /**
     * Create a new component instance.
     */
    public $data;
    public $pendidikanFormal;
    public $pendidikanNonFormal;
    public $kerja;
    public function __construct($data, $for)
    {
        $this->data = $data;
        if ($for == 'data-alumni') {
            $this->pendidikanFormal = PendidikanFormal::where('nik', $this->data->nik)->get();
            $this->pendidikanNonFormal = PendidikanNonFormal::where('nik', $this->data->nik)->get();
            $this->kerja = Kerja::where('nik', $this->data->nik)->get();
        }
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.detail-alumni', [
            'data' => $this->data,
        ]);
    }
}
