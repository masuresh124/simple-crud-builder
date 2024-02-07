<?php
namespace Suresh\SimpleCrudBuilder\FormBuilder;

use Suresh\SimpleCrudBuilder\FormBuilder\Entity\FormEntity;
use Suresh\SimpleCrudBuilder\FormBuilder\FormComponentAbstract;
use Suresh\SimpleCrudBuilder\View\Components\CheckBox;
use Suresh\SimpleCrudBuilder\View\Components\DropDown;
use Suresh\SimpleCrudBuilder\View\Components\File;
use Suresh\SimpleCrudBuilder\View\Components\Radio;
use Suresh\SimpleCrudBuilder\View\Components\Text;
use Suresh\SimpleCrudBuilder\View\Components\TextArea;

class FormComponent extends FormComponentAbstract
{

    public static function text(FormEntity $fieldEntity)
    {
        $fieldRender = new Text($fieldEntity->name, $fieldEntity->value, $fieldEntity->label, $fieldEntity->placeHolder, $fieldEntity->required);
        return self::render($fieldRender);
    }
    public static function textArea(FormEntity $fieldEntity)
    {
        $fieldRender = new TextArea($fieldEntity->name, $fieldEntity->value, $fieldEntity->label, $fieldEntity->placeHolder, $fieldEntity->required);
        return self::render($fieldRender);
    }
    public static function radio(FormEntity $fieldEntity)
    {
        $fieldRender = new Radio($fieldEntity->name, $fieldEntity->choices, $fieldEntity->value);
        return self::render($fieldRender);
    }
    public static function checkBox(FormEntity $fieldEntity)
    {
        $fieldRender = new CheckBox($fieldEntity->name, $fieldEntity->value, $fieldEntity->label, $fieldEntity->required);
        return self::render($fieldRender);
    }
    public static function dropDown(FormEntity $fieldEntity)
    {
        $fieldRender = new DropDown($fieldEntity->name, $fieldEntity->value, $fieldEntity->choices, $fieldEntity->label, $fieldEntity->placeHolder, $fieldEntity->required);
        return self::render($fieldRender);

    }
    public static function file(FormEntity $fieldEntity)
    {
        $fieldRender = new File($fieldEntity->name, $fieldEntity->value, $fieldEntity->label, $fieldEntity->required);
        return self::render($fieldRender);

    }

}
