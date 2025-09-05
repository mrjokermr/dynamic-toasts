<?php

namespace Melle\DynamicToasts;

use Illuminate\Support\ServiceProvider;
use Livewire;
use Melle\DynamicToasts\Livewire\DisplayDynamicToasts;

class DynamicToastsServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadViewsFrom(__DIR__.'/Resources/Views/', 'dynamic-toasts');
        Livewire::component('dynamic-toasts', DisplayDynamicToasts::class);

        $this->mergeConfigFrom(
            __DIR__ . '/Config/dynamic-toasts.php',
            'dynamic-toasts'
        );
    }
}
