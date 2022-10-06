<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\AuthUser\LoginRequest;
use App\Http\Requests\Api\AuthUser\LogoutRequest;
use App\Http\Requests\Api\AuthUser\RegisterRequest;
use App\Http\Requests\Api\AuthUser\UserInfoRequest;

class UserAuthController extends Controller
{
    public function login(LoginRequest $request)
    {
        return $request->run();
    }

    public function register(RegisterRequest $request)
    {
        return $request->run();
    }

    public function logout(LogoutRequest $request)
    {
        return $request->run();
    }

    public function getUserInfo(UserInfoRequest $request)
    {
        return $request->run();
    }
}
