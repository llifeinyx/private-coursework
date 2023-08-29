<?php

namespace App\Guests\Models;

use Illuminate\Database\Eloquent\Model;

class Guest extends Model
{
    /**
     * @var string
     */
    protected $table = 'guests';

    /**
     * @var string[]
     */
    protected $guarded = ['id', 'created_at', 'updated_at'];
}
