<?php

namespace App\Requests\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Validation\Builder;

class CreateRequestRequest extends FormRequest
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return Builder::get([
            'description' => Builder::required()->text(),
            'item_id' => Builder::required()->integer(),
            'phone' => Builder::required()->string(),
            'email' => Builder::required()->email(),
            'name' => Builder::required()->string(),
            'lastname' => Builder::required()->string(),
        ]);
    }
}
