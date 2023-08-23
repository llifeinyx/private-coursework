{!! "<"."?php" !!}

namespace App\{{ $namespace }}Facades;

use Illuminate\Support\Facades\Facade;

class {{ $names }} extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \App\{{ $namespace }}Contracts\{{ $name }}Manager::class;
    }
}