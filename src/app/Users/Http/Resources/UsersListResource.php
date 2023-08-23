<?php

namespace App\Users\Http\Resources;

use App\Http\Resources\ResourceCollection;
use App\Traits\Http\Resources\JsonResourceTrait;

class UsersListResource extends ResourceCollection
{
    // uncomment if need it
    // use JsonResourceTrait;

    protected function itemToArray($user, $request)
    {
        return [
            'id' => $user->id,
            
        ];
    }
}