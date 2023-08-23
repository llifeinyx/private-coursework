<?php

namespace App\Users\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Users\Facades\Users;
use App\Users\Http\Requests\LoginRequest;
use App\Users\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;


class UserController extends Controller
{
    /**
     * Login
     *
     * @param LoginRequest $request
     *
     * @return array
     * @throws ValidationException
     */
    public function login(LoginRequest $request)
    {
        $data = $request->validated();
        $email = $data['email'];
        $password = $data['password'];
        $device = $data['device'] ?? substr($request->header('User-Agent'), 0, 255);

        $user = Users::login($email, $password, $device);

        if ($user === null) {
            throw ValidationException::withMessages([
                'email' => trans('auth.failed'),
            ]);
        }

        return [
            'token' => $user->currentAccessToken()->plainTextToken,
            'user' => new UserResource($user),
        ];
    }

    /**
     * Logout
     *
     * @param Request $request
     */
    public function logout(Request $request)
    {
        Users::logout((bool) $request->input('all'));
    }

    /**
     * Show user date
     *
     * @param Request $request
     * @return UserResource
     */
    public function user(Request $request): UserResource
    {
        return new UserResource($request->user());
    }
}
