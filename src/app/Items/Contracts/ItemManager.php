<?php

namespace App\Items\Contracts;

use App\Items\Models\Item;

interface ItemManager
{
    /**
     * Create a item from the given input
     * 
     * @param array $data
     * @return Item
     */
    public function create(array $data);

    /**
     * Search items
     * 
     * @param array $params
     * @return \Illuminate\Pagination\Paginator
     */
    public function search(array $params);

    /**
     * Update the item within the given input
     * 
     * @param Item $item
     * @param array $data
     */
    public function update(Item $item, array $data);

    /**
     * Delete the given item
     * 
     * @param Item $item
     */
    public function delete(Item $item);
}