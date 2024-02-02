<?php
namespace Suresh\SimpleCrudBuilder\View\Components\Entity;

class FormComponentEntity extends ComponentEntity
{
    public $name;
    public $value;
    public $label;
    public $placeholder;
    public $required;
    public $selected;
    public $options;
    public $showAll;
    public $attribute;

    public function __construct()
    {
        $this->name        = null;
        $this->value       = null;
        $this->label       = null;
        $this->placeholder = null;
        $this->required    = false;
        $this->attribute   = [];

    }
}
