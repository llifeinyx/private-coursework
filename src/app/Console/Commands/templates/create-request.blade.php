{!! "<"."?php" !!}

namespace App\{{ $namespace }}Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Validation\Builder;

class Create{{ $name }}Request extends FormRequest
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return Builder::get([
            
        ]);
    }
}