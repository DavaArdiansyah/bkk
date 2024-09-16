<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Input extends Component
{
    /**
     * Create a new component instance.
     */
    public $type;
    public $name;
    public $label;
    public $placeholder;
    public $value;
    public $class;
    public $required;
    public $min;
    public $matchPassword;
    public function __construct($type = 'text', $name, $label = null, $placeholder = null, $value = null, $class = null, $required = null, $min = null, $matchPassword = null)
    {
        $this->type = $type;
        $this->name = $name;
        $this->label = $label;
        $this->placeholder = $placeholder;
        $this->value = $value;
        $this->class = $class;
        $this->required = $required;
        $this->min = $min;
        $this->matchPassword = $matchPassword;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.input');
    }
}
