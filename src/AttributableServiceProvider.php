<?php

namespace RingierIMU\Attributable;

use Illuminate\Support\ServiceProvider;

class AttributableServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../config/rimu-attributable.php', 'rimu-attributable'
        );
    }

    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/rimu-attributable.php' => config_path('rimu-attributable.php'),
            ]);

            $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        }

        if ($this->app->runningUnitTests()) {
            $this->loadMigrationsFrom(__DIR__.'/../tests/fixtures/database/migrations');
        }
    }
}
