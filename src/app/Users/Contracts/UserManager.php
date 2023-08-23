<?php

namespace App\Users\Contracts;

use App\Users\Models\User;

interface UserManager
{
    /**
     * Log user in
     *
     * @param string $email
     * @param string $password
     * @param string $device
     * @return User|null
     */
    public function login(string $email, string $password, string $device): ?User;

    /**
     * Log user out
     *
     * @param bool $allDevices
     */
    public function logout(bool $allDevices = true): void;
}
