<?php

namespace JeroenG\Generators;

use Illuminate\Support\ServiceProvider;

class GeneratorsServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        // This package is only necessary when using the CLI.
        if ($this->app->runningInConsole()) {

            // Registering package commands.
            $this->commands([
                BatchGenerator::class,
                View::class,
                GenericFile::class,
            ]);
        }
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        //
    }
}