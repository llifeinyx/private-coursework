<?php

namespace App\Guests\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Validation\Builder;

class CreateGuestRequest extends FormRequest
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