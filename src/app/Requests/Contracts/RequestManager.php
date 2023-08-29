<?php

namespace App\Requests\Contracts;

use App\Requests\Models\Request;

interface RequestManager
{
    /**
     * Create a request from the given input
     * 
     * @param array $data
     * @return Request
     */
    public function create(array $data);

    /**
     * Search requests
     * 
     * @param array $params
     * @return \Illuminate\Pagination\Paginator
     */
    public function search(array $params);

    /**
     * Update the request within the given input
     * 
     * @param Request $request
     * @param array $data
     */
    public function update(Request $request, array $data);

    /**
     * Delete the given request
     * 
     * @param Request $request
     */
    public function delete(Request $request);
}