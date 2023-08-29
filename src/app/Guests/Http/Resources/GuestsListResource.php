<?php

namespace App\Guests\Http\Resources;

use App\Http\Resources\ResourceCollection;
use App\Traits\Http\Resources\JsonResourceTrait;

class GuestsListResource extends ResourceCollection
{
    // uncomment if need it
    // use JsonResourceTrait;

    protected function itemToArray($guest, $request)
    {
        return [
            'id' => $guest->id,
            
        ];
    }
}