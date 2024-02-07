<?php

namespace Suresh\SimpleCrudBuilder\View\Components;

use Illuminate\View\Component;
use Suresh\SimpleCrudBuilder\View\Components\Entity\FormComponentEntity;

class Radio extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $name;
    public $choices;
    public $value;

    public function __construct($name = null, $choices = [], $value = null)
    {
        $this->name    = $name;
        $this->choices = $choices;
        $this->value   = $value;

    }
    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $data          = new FormComponentEntity;
        $data->name    = $this->name;
        $data->choices = $this->choices;
        $data->value   = $this->value;
        return view('simple-crud-builder::components.radio', compact('data'));
    }
}
