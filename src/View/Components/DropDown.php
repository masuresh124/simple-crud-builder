<?php

namespace Masuresh124\SimpleCrudBuilder\View\Components;

use Illuminate\View\Component;
use Masuresh124\SimpleCrudBuilder\View\Components\Entity\FormComponentEntity;

class DropDown extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $name;
    public $value;
    public $choices;
    public $label;
    public $required;
    public $placeholder;

    public function __construct($name = null, $value = null, $choices = null, $label = null, $placeholder = null, $required = false)
    {
        $this->name        = $name;
        $this->value       = $value;
        $this->choices     = $choices;
        $this->label       = $label;
        $this->placeholder = $placeholder;
        $this->required    = $required;
    }
    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $data              = new FormComponentEntity;
        $data->name        = $this->name;
        $data->value       = $this->value;
        $data->choices     = $this->choices;
        $data->label       = $this->label;
        $data->placeholder = $this->placeholder;
        $data->required    = $this->required;
        return view('simple-crud-builder::components.drop-down', compact('data'));
    }
}
