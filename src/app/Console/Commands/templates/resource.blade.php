{!! "<"."?php" !!}

namespace App\{{ $namespace }}Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Traits\Http\Resources\JsonResourceTrait;

class {{ $name }}Resource extends JsonResource
{
    // uncomment if need it
    // use JsonResourceTrait;

    /**
     * @inheritdoc
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            
        ];
    }
}
