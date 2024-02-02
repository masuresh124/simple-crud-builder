<?php
namespace Suresh\SimpleCrudBuilder\View\Components\Entity;

class ComponentEntity
{
    public $method;
    public $action;
    public $file;
    public $methoFun;


    public function __construct()
    {
        $this->method        = null;
        $this->action        = null;
        $this->file        = null;
        $this->methoFun        = null;


    }
}
