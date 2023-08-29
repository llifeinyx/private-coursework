<?php

namespace App\Guests\Services;

use App\Guests\Models\Guest;
use App\Traits\Models\SearchableTrait;
use App\Guests\Events\GuestWasCreated;
use App\Guests\Events\GuestWasUpdated;
use App\Guests\Events\GuestWasDeleted;

class GuestManager implements \App\Guests\Contracts\GuestManager
{
    use SearchableTrait;

    /**
     * @inheritdoc
     */
    public function create(array $data)
    {
        $guest = Guest::create($data);

        event(new GuestWasCreated($guest));

        return $guest;
    }

    /**
     * @inheritdoc
     */
    public function search(array $params)
    {
        return $this->performSearch(Guest::query(), $params);
    }

    /**
     * @inheritdoc
     */
    public function update(Guest $guest, array $data)
    {
        $guest->fill($data);
        $guest->save();

        event(new GuestWasUpdated($guest));
    }

    /**
     * @inheritdoc
     */
    public function delete(Guest $guest)
    {
        $guest->delete();

        event(new GuestWasDeleted($guest));
    }
}
