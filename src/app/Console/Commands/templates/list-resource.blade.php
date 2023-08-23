{!! "<"."?php" !!}

namespace App\{{ $namespace }}Http\Resources;

use App\Http\Resources\ResourceCollection;
use App\Traits\Http\Resources\JsonResourceTrait;

class {{ $names }}ListResource extends ResourceCollection
{
    // uncomment if need it
    // use JsonResourceTrait;

    protected function itemToArray(${{ $var }}, $request)
    {
        return [
            'id' => ${{ $var }}->id,
            
        ];
    }
}