<?php

namespace App\Items\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class ItemsListResource extends ResourceCollection
{
    public function toArray($request)
    {
        return [
            'data' => ItemResource::collection($this->collection)
        ];
    }
}
