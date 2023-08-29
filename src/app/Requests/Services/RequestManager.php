<?php

namespace App\Requests\Services;

use App\Guests\Models\Guest;
use App\Requests\Models\Request;
use App\Requests\Events\RequestWasCreated;
use App\Requests\Events\RequestWasUpdated;
use App\Requests\Events\RequestWasDeleted;
use App\Traits\Services\SearchableTrait;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class RequestManager implements \App\Requests\Contracts\RequestManager
{
    use SearchableTrait;

    /**
     * @inheritdoc
     */
    public function create(array $data)
    {
        $requestData = $this->makeRequestData($data);
        $guestData = $this->makeGuestData($data);

        $request = DB::transaction(function () use ($guestData, $requestData) {
            $guest = Guest::query()->firstWhere('email', $guestData['email']);

            if (!$guest) {
                $guest = Guest::create($guestData);
            }

            $requestData['guest_id'] = $guest->id;

            return Request::create($requestData);
        });

        event(new RequestWasCreated($request));

        return $request;
    }

    /**
     * @inheritdoc
     */
    public function search(array $params)
    {
        return $this->performSearch(Request::query(), $params);
    }

    /**
     * @inheritdoc
     */
    public function update(Request $request, array $data)
    {
        $request->fill($data);
        $request->save();

        event(new RequestWasUpdated($request));
    }

    /**
     * @inheritdoc
     */
    public function delete(Request $request)
    {
        $request->delete();

        event(new RequestWasDeleted($request));
    }

    /**
     * Make request data
     *
     * @param array $data
     * @return array
     */
    protected function makeRequestData(array & $data)
    {
        return Arr::only($data, ['description', 'item_id']);
    }

    /**
     * Make guest data
     *
     * @param array $data
     * @return array
     */
    protected function makeGuestData(array & $data)
    {
        return Arr::except($data, ['description', 'item_id']);
    }
}
