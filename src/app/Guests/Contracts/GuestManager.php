<?php

namespace App\Guests\Contracts;

use App\Guests\Models\Guest;

interface GuestManager
{
    /**
     * Create a guest from the given input
     * 
     * @param array $data
     * @return Guest
     */
    public function create(array $data);

    /**
     * Search guests
     * 
     * @param array $params
     * @return \Illuminate\Pagination\Paginator
     */
    public function search(array $params);

    /**
     * Update the guest within the given input
     * 
     * @param Guest $guest
     * @param array $data
     */
    public function update(Guest $guest, array $data);

    /**
     * Delete the given guest
     * 
     * @param Guest $guest
     */
    public function delete(Guest $guest);
}