<?php

namespace App\Users\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Validation\Builder;

class LoginRequest extends FormRequest
{
    public function rules()
    {
        return Builder::get([
            'email' => Builder::required()->email(),
            'password' => Builder::required(),
            'device' => Builder::string(1, 255),
        ]);
    }
}
