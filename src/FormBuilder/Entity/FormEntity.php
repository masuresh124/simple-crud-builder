<?php
namespace Suresh\SimpleCrudBuilder\FormBuilder\Entity;

class FormEntity
{

    public $name;
    public $type;
    public $label;
    public $placeHolder;
    public $value;
    public $required;
    public $keyName;
    public function __construct()
    {
        $this->required = false;

    }
}
