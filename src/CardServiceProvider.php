<?php

namespace Fintech\Card;

use Fintech\Card\Commands\CardCommand;
use Fintech\Card\Commands\InstallCommand;
use Illuminate\Support\ServiceProvider;

class CardServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/card.php', 'fintech.card'
        );

        $this->app->register(RouteServiceProvider::class);
        $this->app->register(RepositoryServiceProvider::class);
    }

    /**
     * Bootstrap any package services.
     */
    public function boot(): void
    {
        $this->publishes([
            __DIR__.'/../config/card.php' => config_path('fintech/card.php'),
        ]);

        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');

        $this->loadTranslationsFrom(__DIR__.'/../lang', 'card');

        $this->publishes([
            __DIR__.'/../lang' => $this->app->langPath('vendor/card'),
        ]);

        $this->loadViewsFrom(__DIR__.'/../resources/views', 'card');

        $this->publishes([
            __DIR__.'/../resources/views' => resource_path('views/vendor/card'),
        ]);

        if ($this->app->runningInConsole()) {
            $this->commands([
                InstallCommand::class,
                CardCommand::class,
            ]);
        }
    }
}
