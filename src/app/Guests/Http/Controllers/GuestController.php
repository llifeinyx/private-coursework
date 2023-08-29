<?php

namespace App\Guests\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Guests\Models\Guest;
use App\Guests\Http\Requests\CreateGuestRequest;
use App\Guests\Http\Requests\UpdateGuestRequest;
use App\Http\Requests\SearchRequest;
use App\Guests\Facades\Guests;
use App\Guests\Http\Resources\GuestResource;
use App\Guests\Http\Resources\GuestsListResource;
use Illuminate\Http\JsonResponse;
use App\Guests\Exceptions\CreateGuestException;
use App\Guests\Exceptions\UpdateGuestException;
use App\Guests\Exceptions\DeleteGuestException;

class GuestController extends Controller
{
    /**
     * List guests
     * 
     * @param SearchRequest $request
     * @return GuestsListResource
     */
    public function index(SearchRequest $request)
    {
        $this->authorize('read', Guest::class);

        $guests = Guests::search($request->validated());

        return new GuestsListResource($guests);
    }

    /**
     * Show guest data
     * 
     * @param Guest $guest
     * @return GuestResource
     */
    public function get(Guest $guest)
    {
        $this->authorize('read', $guest);

        return new GuestResource($guest);
    }

    /**
     * Create a guest
     * 
     * @param CreateGuestRequest $request
     * @return GuestResource
     */
    public function create(CreateGuestRequest $request)
    {
        $this->authorize('create', Guest::class);

        $data = $request->validated();
        
        try {
            $guest = Guests::create($data);
        } catch (CreateGuestException $e) {
            return new JsonResponse([
                'message' => $e->getMessage(),
            ], 400);
        }

        return new GuestResource($guest);
    }

    /**
     * Update guest data
     * 
     * @param Guest $guest
     * @param UpdateGuestRequest $request
     * @return GuestResource
     */
    public function update(Guest $guest, UpdateGuestRequest $request)
    {
        $this->authorize('update', $guest);

        $data = $request->validated();

        try {
            Guests::update($guest, $data);
        } catch (UpdateGuestException $e) {
            return new JsonResponse([
                'message' => $e->getMessage(),
            ], 400);
        }

        return new GuestResource($guest);
    }

    /**
     * Delete guest
     * 
     * @param Guest $guest
     */
    public function delete(Guest $guest)
    {
        $this->authorize('delete', $guest);

        try {
            Guests::delete($guest);
        } catch (DeleteGuestException $e) {
            return new JsonResponse([
                'message' => $e->getMessage(),
            ], 400);
        }        
    }
}