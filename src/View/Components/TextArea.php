<?php

namespace Masuresh124\SimpleCrudBuilder\View\Components;

use Illuminate\View\Component;

class TextArea extends BaseText
{
    /**
     * Create a new component instance.
     *
     * @return void
     */

    public function __construct($name = null, $value = null, $label = null, $placeholder = null, $required = false)
    {
        parent::__construct($name, $value, $label, $placeholder, $required);
    }
    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $data = parent::render();
        return view('simple-crud-builder::components.text-area', compact('data'));
    }
}
