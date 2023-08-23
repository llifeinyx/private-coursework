{!! "<"."?php" !!}

namespace App\{{ $namespace }}Models;

use Illuminate\Database\Eloquent\Model;

class {{ $name }} extends Model
{
    /**
     * @var string
     */
    protected $table = '{{ \Illuminate\Support\Str::snake($vars) }}';
}