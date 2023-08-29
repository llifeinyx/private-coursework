<?php

namespace App\Policies;

class BaseCrudPolicy
{
    public function read($user)
    {
        return true;
    }

    public function create($user)
    {
        return true;
    }

    public function update($user)
    {
        return true;
    }

    public function delete($user)
    {
        return true;
    }
}
