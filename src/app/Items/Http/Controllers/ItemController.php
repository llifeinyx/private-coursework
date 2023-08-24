<?php

namespace App\Items\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Items\Models\Item;
use App\Items\Http\Requests\CreateItemRequest;
use App\Items\Http\Requests\UpdateItemRequest;
use App\Http\Requests\SearchRequest;
use App\Items\Facades\Items;
use App\Items\Http\Resources\ItemResource;
use App\Items\Http\Resources\ItemsListResource;
use Illuminate\Http\JsonResponse;
use App\Items\Exceptions\CreateItemException;
use App\Items\Exceptions\UpdateItemException;
use App\Items\Exceptions\DeleteItemException;

class ItemController extends Controller
{
    /**
     * List items
     * 
     * @param SearchRequest $request
     * @return ItemsListResource
     */
    public function index(SearchRequest $request)
    {
        $this->authorize('read', Item::class);

        $items = Items::search($request->validated());

        return new ItemsListResource($items);
    }

    /**
     * Show item data
     * 
     * @param Item $item
     * @return ItemResource
     */
    public function get(Item $item)
    {
        $this->authorize('read', $item);

        return new ItemResource($item);
    }

    /**
     * Create a item
     * 
     * @param CreateItemRequest $request
     * @return ItemResource
     */
    public function create(CreateItemRequest $request)
    {
        $this->authorize('create', Item::class);

        $data = $request->validated();
        
        try {
            $item = Items::create($data);
        } catch (CreateItemException $e) {
            return new JsonResponse([
                'message' => $e->getMessage(),
            ], 400);
        }

        return new ItemResource($item);
    }

    /**
     * Update item data
     * 
     * @param Item $item
     * @param UpdateItemRequest $request
     * @return ItemResource
     */
    public function update(Item $item, UpdateItemRequest $request)
    {
        $this->authorize('update', $item);

        $data = $request->validated();

        try {
            Items::update($item, $data);
        } catch (UpdateItemException $e) {
            return new JsonResponse([
                'message' => $e->getMessage(),
            ], 400);
        }

        return new ItemResource($item);
    }

    /**
     * Delete item
     * 
     * @param Item $item
     */
    public function delete(Item $item)
    {
        $this->authorize('delete', $item);

        try {
            Items::delete($item);
        } catch (DeleteItemException $e) {
            return new JsonResponse([
                'message' => $e->getMessage(),
            ], 400);
        }        
    }
}