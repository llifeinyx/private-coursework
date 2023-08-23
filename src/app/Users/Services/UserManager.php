<?php

namespace App\Users\Services;

use App\Users\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserManager implements \App\Users\Contracts\UserManager
{
    /**
     * @inheritdoc
     */
    public function login($email, $password, $device): ?User
    {
        $user = User::where('email', $email)->first();

        if (!$user || !Hash::check($password, $user->password)) {
            return null;
        }

        // Re-create token for this device
        $user->tokens()
            ->where('name', $device)
            ->delete();

        return $user->withAccessToken($user->createToken($device));
    }

    /**
     * @inheritdoc
     */
    public function logout($allDevices = true): void
    {
        if ($allDevices) {
            Auth::user()
                ->tokens()
                ->delete();
        } else {
            Auth::user()
                ->currentAccessToken()
                ->delete();
        }
    }
}
