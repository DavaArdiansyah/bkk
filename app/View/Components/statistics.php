<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class statistics extends Component
{
    /**
     * Create a new component instance.
     */

    public $title;
    public $icon;
    public $data;
    public function __construct($title, $icon, $data)
    {
        $this->title = $title;
        $this->icon = $icon;
        $this->data = $data;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.statistics', [
            'data' => $this->data
        ]);
    }
}
