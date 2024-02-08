<?php

namespace Masuresh124\SimpleCrudBuilder\View\Components;

use Illuminate\View\Component;
use Masuresh124\SimpleCrudBuilder\View\Components\Entity\FormComponentEntity;

class BaseText extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $name;
    public $value;
    public $label;
    public $placeholder;
    public $required;

    public function __construct($name, $value, $label, $placeholder, $required)
    {
        $this->name        = $name;
        $this->value       = $value;
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
        $data->label       = $this->label;
        $data->placeholder = $this->placeholder;
        $data->required    = $this->required;
        return $data;
    }
}
