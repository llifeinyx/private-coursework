<?php

namespace App\Items\Http\Resources;

use App\Http\Resources\ResourceCollection;
use App\Traits\Http\Resources\JsonResourceTrait;

class ItemsListResource extends ResourceCollection
{
    // uncomment if need it
    // use JsonResourceTrait;

    protected function itemToArray($item, $request)
    {
        return [
            'id' => $item->id,
            
        ];
    }
}