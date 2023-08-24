<?php

namespace App\Items\Models;

use App\Items\Models\Enums\Status;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    /**
     * @var string
     */
    protected $table = 'items';

    /**
     * @var string[]
     */
    protected $guarded = ['id', 'created_at', 'updated_at'];

    /**
     * @var string[]
     */
    protected $casts = [
        'status' => Status::class,
    ];
}
