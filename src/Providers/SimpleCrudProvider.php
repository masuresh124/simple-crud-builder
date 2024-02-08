<?php

namespace Masuresh124\SimpleCrudBuilder\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Masuresh124\SimpleCrudBuilder\FormBuilder\FormBuilder;

class SimpleCrudProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadViewsFrom(__DIR__ . '/../views', 'simple-crud-builder');
        Blade::componentNamespace("Masuresh124\\SimpleCrudBuilder\\View\\Components", 'simple-crud-builder');
    }

    public function register()
    {
        //
        $this->app->bind('formbuilder', function () {
            return new FormBuilder();
        });
    }
}
