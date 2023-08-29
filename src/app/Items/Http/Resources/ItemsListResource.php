<?php

namespace App\Items\Http\Resources;



use App\Users\Http\Resources\UserResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ItemsListResource extends ResourceCollection
{
    protected function itemToArray($item, $request)
    {
        return [
            'id' => $item->id,
            'name' => $item->name,
            'description' => $item->description,
            'status' => $item->status,
            'given_by_id' => $this->when($item->given_by_id !== null, function () use ($item) {
                return new UserResource($item->given_by);
            }),
            'taken_by_id' => $this->when($item->taken_by_id !== null, function () use ($item) {
                return new UserResource($item->taken_by);
            }),
            'created_at' => $item->created_at,
            'updated_at' => $item->updated_at,
        ];
    }
}
