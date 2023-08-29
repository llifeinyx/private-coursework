<?php

namespace App\Requests\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Requests\Models\Request;
use App\Requests\Http\Requests\CreateRequestRequest;
use App\Http\Requests\SearchRequest;
use App\Requests\Facades\Requests;
use App\Requests\Http\Resources\RequestResource;
use App\Requests\Http\Resources\RequestsListResource;
use Illuminate\Http\JsonResponse;
use App\Requests\Exceptions\CreateRequestException;

class RequestController extends Controller
{
    /**
     * List requests
     *
     * @param SearchRequest $request
     * @return RequestsListResource
     */
    public function index(SearchRequest $request)
    {
        $this->authorize('read', Request::class);

        $requests = Requests::search($request->validated());

        return new RequestsListResource($requests);
    }

    /**
     * Show request data
     *
     * @param Request $request
     * @return RequestResource
     */
    public function get(Request $request)
    {
        $this->authorize('read', $request);

        return new RequestResource($request);
    }

    /**
     * Create a request
     *
     * @param CreateRequestRequest $request
     * @return RequestResource
     */
    public function create(CreateRequestRequest $request)
    {
        $this->authorize('create', Request::class);

        $data = $request->validated();

        try {
            $request = Requests::create($data);
        } catch (CreateRequestException $e) {
            return new JsonResponse([
                'message' => $e->getMessage(),
            ], 400);
        }

        return new RequestResource($request);
    }
}
