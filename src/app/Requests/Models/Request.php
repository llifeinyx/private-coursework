<?php

namespace App\Requests\Models;

use App\Guests\Models\Guest;
use App\Items\Models\Item;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Request extends Model
{
    /**
     * @var string
     */
    protected $table = 'requests';

    /**
     * @var string[]
     */
    protected $guarded = ['id', 'created_at', 'updated_at'];

    /**
     * @var string[]
     */
    protected $with = ['guest', 'item'];

    /**
     * Return related guest
     *
     * @return BelongsTo
     */
    public function guest()
    {
        return $this->belongsTo(Guest::class, 'guest_id');
    }

    /**
     * Return related item
     *
     * @return BelongsTo
     */
    public function item()
    {
        return $this->belongsTo(Item::class, 'item_id');
    }
}
