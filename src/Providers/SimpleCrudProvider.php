<?php

namespace Suresh\SimpleCrudBuilder\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Suresh\SimpleCrudBuilder\FormBuilder\FormBuilder;

class SimpleCrudProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__ . '/../routes/web.php');
        $this->loadViewsFrom(__DIR__ . '/../views', 'simple-crud-builder');
        Blade::componentNamespace("Suresh\\SimpleCrudBuilder\\View\\Components", 'simple-crud-builder');
    }

    public function register()
    {
        //
        $this->app->bind('formbuilder', function () {
            return new FormBuilder();
        });
    }
}
