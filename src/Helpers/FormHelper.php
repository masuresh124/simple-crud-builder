<?php

namespace Suresh\SimpleCrudBuilder\Helpers;

use Illuminate\Database\Eloquent\Model;

class FormHelper
{

    public static function testHelper()
    {

    }

    public static function isModelNew(Model $entity)
    {
        return isset($entity->id) && $entity->id !== null ? false : true;
    }

    public static function validInput($input, $key = null)
    {
        if (is_object($input)) {
            return $input->$key ? $input->$key : null;
        } elseif (is_array($input)) {
            return isset($input[$key]) ? $input[$key] : '';
        } else {
            return isset($input) ? $input : null;
        }
    }

}
