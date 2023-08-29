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
        $this->app->bind(\App\Guests\Contracts\GuestManager::class, function ($app) {
            return new \App\Guests\Services\GuestManager();
        });
        $this->app->bind(\App\Requests\Contracts\RequestManager::class, function ($app) {
            return new \App\Requests\Services\RequestManager();
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
