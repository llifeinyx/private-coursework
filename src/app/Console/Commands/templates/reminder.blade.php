// --------------------------------------
// app/Providers/AppServiceProvider.php

$this->app->bind(\App\{{ $namespace }}Contracts\{{ $name }}Manager::class, function ($app) {
    return new \App\{{ $namespace }}Services\{{ $name }}Manager();
});

// --------------------------------------
// app/Providers/AuthServiceProvider.php

\App\{{ $namespace }}Models\{{ $name }}::class => \App\{{ $namespace }}Policies\{{ $name }}Policy::class,

// --------------------------------------
// app/Providers/RouteServiceProvider.php

Route::middleware('api')
    ->prefix('api')
    ->group(base_path('routes/{{ $namespace ? (\Illuminate\Support\Str::snake($name, '-') . '/') : '' }}api.php'));