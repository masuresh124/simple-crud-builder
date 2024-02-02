<?php
namespace Suresh\SimpleCrudBuilder\FormBuilder;

abstract class FormBuilderAbstract
{
    abstract public static function createFormSimpleBuilder($entity, $formClass, $view, $actionUrl, $redirectTo = null, $message = null);
}
