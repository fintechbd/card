<?php

namespace Fintech\Card\Providers;

use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider implements DeferrableProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        foreach (Config::get('fintech.card.repositories', []) as $interface => $binding) {
            $this->app->bind($interface, function ($app) use ($binding) {
                return $app->make($binding);
            });
        }
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array<int, string>
     */
    public function provides(): array
    {
        return array_keys(Config::get('fintech.card.repositories', []));
    }
}
