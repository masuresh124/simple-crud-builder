<?php
namespace Suresh\SimpleCrudBuilder\FormBuilder;

use Suresh\SimpleCrudBuilder\FormBuilder\Entity\FormEntity;

abstract class FormComponentAbstract
{
    abstract public static function text(FormEntity $fieldEntity);
    abstract public static function textArea(FormEntity $fieldEntity);
    abstract public static function radio(FormEntity $fieldEntity);
    abstract public static function checkBox(FormEntity $fieldEntity);
    abstract public static function dropDown(FormEntity $fieldEntity);
    abstract public static function file(FormEntity $fieldEntity);

    public static function render($fieldRender = null)
    {
        if (!$fieldRender) {
            throw new \Exception("View render not done");
        }
        return $fieldRender->render()->with($fieldRender->data());
    }
}
