<?php

namespace App\Requests\Facades;

use Illuminate\Support\Facades\Facade;

class Requests extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \App\Requests\Contracts\RequestManager::class;
    }
}