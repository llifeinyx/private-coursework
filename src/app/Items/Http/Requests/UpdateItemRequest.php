<?php

namespace App\Items\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Validation\Builder;

class UpdateItemRequest extends CreateItemRequest
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return Builder::mergeConcat([
            'name' => Builder::sometimes(),
            'description' => Builder::sometimes(),
        ], parent::rules());
    }
}
