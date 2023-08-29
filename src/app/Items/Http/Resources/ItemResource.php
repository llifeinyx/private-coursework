<?php

namespace App\Items\Http\Resources;

use App\Users\Http\Resources\UserResource;
use Illuminate\Http\Resources\Json\JsonResource;

class ItemResource extends JsonResource
{
    /**
     * @inheritdoc
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'status' => $this->status,
            'given_by_id' => $this->when($this->given_by_id !== null, function () {
                return new UserResource($this->given_by);
            }),
            'taken_by_id' => $this->when($this->taken_by_id !== null, function () {
                return new UserResource($this->taken_by);
            }),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
