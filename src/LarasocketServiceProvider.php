<?php

namespace Lamoimage\Larasocket;

use Illuminate\Support\ServiceProvider;

class LarasocketServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
               __DIR__.'/config/larasocket.php' => config_path('larasocket.php')
           ]);

        $this->loadViewsFrom(__DIR__.'/views', 'larasocket');
        $this->publishes([
               __DIR__.'/views' => base_path('resources/views/vendor/larasocket'),
           ]);

        if (! $this->app->routesAreCached()) {
            require __DIR__.'/routes.php';
        }
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/config/larasocket.php', 'larasocket');

        $this->app->bind('Lamoimage\Larasocket\Socket', 'Lamoimage\Larasocket\Larasocket');

        //registe socket control commands
        $this->registerSocketStartCommand();
        $this->registerSocketStopCommand();
        $this->registerSocketRestartCommand();
    }

    public function registerSocketStartCommand()
    {
        $this->app->singleton('command.socket.start', function ($app) {
            return $app['Lamoimage\Larasocket\Commands\LarasocketStartCommand'];
        });
        $this->commands('command.socket.start');
    }

    public function registerSocketStopCommand()
    {
        $this->app->singleton('command.socket.stop', function ($app) {
            return $app['Lamoimage\Larasocket\Commands\LarasocketStopCommand'];
        });
        $this->commands('command.socket.stop');
    }

    public function registerSocketRestartCommand()
    {
        $this->app->singleton('command.socket.restart', function ($app) {
            return $app['Lamoimage\Larasocket\Commands\LarasocketRestartCommand'];
        });
        $this->commands('command.socket.restart');
    }
}
