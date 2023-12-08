<?php

namespace Suresh\SimpleCrudBuilder\Providers;

use Illuminate\Support\ServiceProvider;

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
    }
}
