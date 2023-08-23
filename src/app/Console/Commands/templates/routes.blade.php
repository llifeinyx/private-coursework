{!! "<"."?php" !!}

use Illuminate\Support\Facades\Route;
use App\{{ $namespace }}Http\Controllers\{{ $name }}Controller;

Route::middleware('auth:sanctum')
    ->prefix('{{ \Illuminate\Support\Str::snake($vars, '-') }}')
    ->group(function() {
        Route::get('/', [{{ $name }}Controller::class, 'index']);
        Route::get('/{{ '{'.$var.'}' }}', [{{ $name }}Controller::class, 'get'])->whereNumber('{{ $var }}');
        Route::post('/', [{{ $name }}Controller::class, 'create']);
        Route::post('/{{ '{'.$var.'}' }}', [{{ $name }}Controller::class, 'update'])->whereNumber('{{ $var }}');
        Route::delete('/{{ '{'.$var.'}' }}', [{{ $name }}Controller::class, 'delete'])->whereNumber('{{ $var }}');
    });
