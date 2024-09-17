<?php

namespace App\View\Components\Modal;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Pesan extends Component
{
    /**
     * Create a new component instance.
     */
    public $id;
    public $title;
    public $pesan;
    public function __construct($id, $title, $pesan)
    {
        $this->id = $id;
        $this->title = $title;
        $this->pesan = $pesan;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.modal.pesan');
    }
}
