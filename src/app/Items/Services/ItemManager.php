<?php

namespace App\Items\Services;

use App\Guests\Models\Guest;
use App\Items\Models\Item;
use App\Items\Events\ItemWasCreated;
use App\Items\Events\ItemWasUpdated;
use App\Items\Events\ItemWasDeleted;
use App\Traits\Services\SearchableTrait;
use Illuminate\Support\Facades\DB;

class ItemManager implements \App\Items\Contracts\ItemManager
{
    use SearchableTrait;

    /**
     * @inheritdoc
     */
    public function create(array $data)
    {
        $item = Item::create($data);

        event(new ItemWasCreated($item));

        return $item;
    }

    /**
     * @inheritDoc
     */
    public function giveToGuest(Item $item, Guest $guest)
    {
        DB::transaction(function () use ($item, $guest) {
            $item->taken_by()->associate($guest);
            $item->given_by()->associate(auth()->user());
            $item->save();
        });

        event(new ItemWasUpdated($item));
    }

    /**
     * @inheritdoc
     */
    public function search(array $params)
    {
        return $this->performSearch(Item::query(), $params);
    }

    /**
     * @inheritdoc
     */
    public function update(Item $item, array $data)
    {
        $item->fill($data);
        $item->save();

        event(new ItemWasUpdated($item));
    }

    /**
     * @inheritdoc
     */
    public function delete(Item $item)
    {
        $item->delete();

        event(new ItemWasDeleted($item));
    }
}
