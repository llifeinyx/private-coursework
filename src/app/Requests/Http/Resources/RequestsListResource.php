<?php

namespace App\Requests\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class RequestsListResource extends ResourceCollection
{
    protected function itemToArray($request, $item)
    {
        return new RequestResource($item);
    }
}
