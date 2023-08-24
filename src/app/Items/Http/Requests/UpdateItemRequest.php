<?php

namespace App\Items\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Validation\Builder;

class UpdateItemRequest extends FormRequest
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return Builder::get([
            
        ]);
    }
}