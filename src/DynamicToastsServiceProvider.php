<?php

namespace Mrjokermr\DynamicToasts;

use Illuminate\Support\ServiceProvider;
use Livewire;
use Mrjokermr\DynamicToasts\Livewire\DisplayDynamicToasts;

class DynamicToastsServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->loadViewsFrom(__DIR__ . '/Resources/Views', 'dynamic-toasts');
        Livewire::component('dynamic-toasts', DisplayDynamicToasts::class);

        $this->publishes([
            __DIR__ . '/Config/dynamic-toasts.php' => config_path('dynamic-toasts.php'),
        ], 'dynamic-toasts-config');
    }

    public function register(): void
    {
        $this->mergeConfigFrom(
            __DIR__ . '/Config/dynamic-toasts.php', // adjust if your path differs
            'dynamic-toasts'
        );
    }
}
