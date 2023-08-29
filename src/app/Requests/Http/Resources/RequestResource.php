<?php

namespace App\Requests\Http\Resources;

use App\Guests\Http\Resources\GuestResource;
use App\Items\Http\Resources\ItemResource;
use App\Items\Models\Item;
use Illuminate\Http\Resources\Json\JsonResource;

class RequestResource extends JsonResource
{
    /**
     * @inheritdoc
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'description' => $this->description,
            'guest' => new GuestResource($this->guest),
            'item' => new ItemResource($this->item),
        ];
    }
}
