<?php

namespace CarroPublic\Discussion;

use Illuminate\Support\ServiceProvider;

class DiscussionServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');

        // Publishing is only necessary when using the CLI.
        if ($this->app->runningInConsole()) {
            $this->bootForConsole();
        }
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/discussion.php', 'discussion');

        // Register the service the package provides.
        $this->app->singleton('discussion', function ($app) {
            return new Discussion;
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['discussion'];
    }
    
    /**
     * Console-specific booting.
     *
     * @return void
     */
    protected function bootForConsole()
    {
        // Publishing the configuration file.
        $this->publishes([
            __DIR__.'/../config/discussion.php' => config_path('discussion.php'),
        ], 'discussion.config');

        if (! class_exists('CreateCommentsTable')) {
            $this->publishes([
                __DIR__.'/../database/migrations/create_disucssion_table.php.stub' => database_path('migrations/'.date('Y_m_d_His', time()).'_create_discussion_table.php'),
            ], 'migrations');
        }
    }
}
