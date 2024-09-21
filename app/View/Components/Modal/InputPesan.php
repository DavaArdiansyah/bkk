<?php

namespace App\View\Components\Modal;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class InputPesan extends Component
{
    /**
     * Create a new component instance.
     */
    public $id;
    public $title;
    public $action;
    public $for;
    public function __construct($id, $title, $action, $for)
    {
        $this->id = $id;
        $this->title = $title;
        $this->action = $action;
        $this->for = $for;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.modal.input-pesan');
    }
}
