<?php

namespace App\Guests\Facades;

use Illuminate\Support\Facades\Facade;

class Guests extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \App\Guests\Contracts\GuestManager::class;
    }
}