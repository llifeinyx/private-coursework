<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        \App\Users\Models\User::class => \App\Users\Policies\UserPolicy::class,
        \App\Items\Models\Item::class => \App\Items\Policies\ItemPolicy::class,
        \App\Guests\Models\Guest::class => \App\Guests\Policies\GuestPolicy::class,
        \App\Requests\Models\Request::class => \App\Requests\Policies\RequestPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();
    }
}
