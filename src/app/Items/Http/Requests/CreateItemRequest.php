<?php

namespace App\Items\Http\Requests;

use App\Items\Models\Enums\Status;
use Illuminate\Foundation\Http\FormRequest;
use App\Validation\Builder;

class CreateItemRequest extends FormRequest
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return Builder::get([
            'name' => Builder::required()->string(),
            'description' => Builder::required()->string(),
            'status' => Builder::in(Status::values()),
        ]);
    }
}
