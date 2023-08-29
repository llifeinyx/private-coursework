<?php

namespace App\Items\Models;

use App\Guests\Models\Guest;
use App\Items\Models\Enums\Status;
use App\Users\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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

    /**
     * @var string[]
     */
    protected $with = ['given_by', 'taken_by'];

    /**
     * Return related user which gives this item to a guest.
     *
     * @return BelongsTo
     */
    public function given_by()
    {
        return $this->belongsTo(User::class, 'given_by_id');
    }

    /**
     * Return related guest which takes this item from a user.
     *
     * @return BelongsTo
     */
    public function taken_by()
    {
        return $this->belongsTo(Guest::class, 'taken_by_id');
    }
}
