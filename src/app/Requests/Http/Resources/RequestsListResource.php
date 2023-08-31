<?php

namespace App\Requests\Http\Resources;
use Illuminate\Http\Resources\Json\ResourceCollection;

class RequestsListResource extends ResourceCollection
{
    public function toArray($request)
    {
        return [
            'data' => RequestResource::collection($this->collection)
        ];
    }
}
