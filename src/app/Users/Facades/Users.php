<?php

namespace App\Users\Facades;

use Illuminate\Support\Facades\Facade;

class Users extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \App\Users\Contracts\UserManager::class;
    }
}