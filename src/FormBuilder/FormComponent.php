<?php
namespace Masuresh124\SimpleCrudBuilder\FormBuilder;

use Masuresh124\SimpleCrudBuilder\FormBuilder\Entity\FormEntity;
use Masuresh124\SimpleCrudBuilder\FormBuilder\FormComponentAbstract;
use Masuresh124\SimpleCrudBuilder\View\Components\CheckBox;
use Masuresh124\SimpleCrudBuilder\View\Components\DropDown;
use Masuresh124\SimpleCrudBuilder\View\Components\File;
use Masuresh124\SimpleCrudBuilder\View\Components\Radio;
use Masuresh124\SimpleCrudBuilder\View\Components\Text;
use Masuresh124\SimpleCrudBuilder\View\Components\TextArea;

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
