<?php

namespace App\Items\Facades;

use Illuminate\Support\Facades\Facade;

class Items extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \App\Items\Contracts\ItemManager::class;
    }
}