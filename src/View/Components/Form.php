<?php

namespace Masuresh124\SimpleCrudBuilder\View\Components;

use Illuminate\View\Component;
use Masuresh124\SimpleCrudBuilder\View\Components\Entity\FormComponentEntity;

class Form extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $name;
    public $method;
    public $action;
    public $methoFun;
    public $file;
    public function __construct($name, $method, $action, $file = false)
    {
        $this->name     = $name;
        $this->method   = $method;
        $this->action   = $action;
        $this->methoFun = '';
        $this->file     = $file;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $fieldDetails           = new FormComponentEntity();
        $fieldDetails->name     = $this->name;
        $fieldDetails->method   = $this->method;
        $fieldDetails->action   = $this->action;
        $fieldDetails->file     = $this->file;
        $fieldDetails->methoFun = '';
        if (strtolower($fieldDetails->method) == 'create') {
            $fieldDetails->methoFun = 'POST';
            $fieldDetails->method   = 'POST';
        } else if (strtolower($fieldDetails->method) == 'update') {
            $fieldDetails->method   = 'POST';
            $fieldDetails->methoFun = 'PUT';
        }
        return view('simple-crud-builder::components.form', compact('fieldDetails'));
    }
}
