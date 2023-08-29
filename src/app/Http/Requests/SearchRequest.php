<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Validation\Builder;

class SearchRequest extends FormRequest
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return Builder::get([
            'filter' => Builder::array(),
            'sort' => Builder::array(),
            'page' => Builder::integer()->min(1),
            'limit' => Builder::integer()->between(1, 500),
        ]);
    }
}
