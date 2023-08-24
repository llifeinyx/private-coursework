<?php

namespace App\Providers;

use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(\App\Users\Contracts\UserManager::class, function ($app) {
            return new \App\Users\Services\UserManager();
        });
        $this->app->bind(\App\Items\Contracts\ItemManager::class, function ($app) {
            return new \App\Items\Services\ItemManager();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Relations morph map
        Relation::enforceMorphMap([
            'user' => \App\Users\Models\User::class,
        ]);
    }
}
