<?php

namespace App\Users\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * @inheritdoc
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'email' => $this->email,
        ];
    }
}
