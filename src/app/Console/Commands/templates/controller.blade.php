{!! "<"."?php" !!}

namespace App\{{ $namespace }}Http\Controllers;

use App\Http\Controllers\Controller;
use App\{{ $namespace }}Models\{{ $name }};
use App\{{ $namespace }}Http\Requests\Create{{ $name }}Request;
use App\{{ $namespace }}Http\Requests\Update{{ $name }}Request;
use App\Http\Requests\SearchRequest;
use App\{{ $namespace }}Facades\{{ $names }};
use App\{{ $namespace }}Http\Resources\{{ $name }}Resource;
use App\{{ $namespace }}Http\Resources\{{ $names }}ListResource;
use Illuminate\Http\JsonResponse;
use App\{{ $namespace }}Exceptions\Create{{ $name }}Exception;
use App\{{ $namespace }}Exceptions\Update{{ $name }}Exception;
use App\{{ $namespace }}Exceptions\Delete{{ $name }}Exception;

class {{ $name }}Controller extends Controller
{
    /**
     * List {{ $vars }}
     * 
     * @param SearchRequest $request
     * @return {{ $names }}ListResource
     */
    public function index(SearchRequest $request)
    {
        $this->authorize('read', {{ $name }}::class);

        ${{ $vars }} = {{ $names }}::search($request->validated());

        return new {{ $names }}ListResource(${{ $vars }});
    }

    /**
     * Show {{ $var }} data
     * 
     * @param {{ $name }} ${{ $var }}
     * @return {{ $name }}Resource
     */
    public function get({{ $name }} ${{ $var }})
    {
        $this->authorize('read', ${{ $var }});

        return new {{ $name }}Resource(${{ $var }});
    }

    /**
     * Create a {{ $var }}
     * 
     * @param Create{{ $name }}Request $request
     * @return {{ $name }}Resource
     */
    public function create(Create{{ $name }}Request $request)
    {
        $this->authorize('create', {{ $name }}::class);

        $data = $request->validated();
        
        try {
            ${{ $var }} = {{ $names }}::create($data);
        } catch (Create{{ $name }}Exception $e) {
            return new JsonResponse([
                'message' => $e->getMessage(),
            ], 400);
        }

        return new {{ $name }}Resource(${{ $var }});
    }

    /**
     * Update {{ $var }} data
     * 
     * @param {{ $name }} ${{ $var }}
     * @param Update{{ $name }}Request $request
     * @return {{ $name }}Resource
     */
    public function update({{ $name }} ${{ $var }}, Update{{ $name }}Request $request)
    {
        $this->authorize('update', ${{ $var }});

        $data = $request->validated();

        try {
            {{ $names }}::update(${{ $var }}, $data);
        } catch (Update{{ $name }}Exception $e) {
            return new JsonResponse([
                'message' => $e->getMessage(),
            ], 400);
        }

        return new {{ $name }}Resource(${{ $var }});
    }

    /**
     * Delete {{ $var }}
     * 
     * @param {{ $name }} ${{ $var }}
     */
    public function delete({{ $name }} ${{ $var }})
    {
        $this->authorize('delete', ${{ $var }});

        try {
            {{ $names }}::delete(${{ $var }});
        } catch (Delete{{ $name }}Exception $e) {
            return new JsonResponse([
                'message' => $e->getMessage(),
            ], 400);
        }        
    }
}