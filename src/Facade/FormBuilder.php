<?php
namespace Masuresh124\SimpleCrudBuilder\Facade;

use Illuminate\Support\Facades\Facade;

class FormBuilder extends Facade
{
    /**
     * {@inheritDoc}
     */
    protected static function getFacadeAccessor()
    {
        return  'formbuilder';
    }
}
