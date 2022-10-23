<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\User\ChangePasswordRequest;
use App\Http\Requests\Api\User\DestroyRequest;
use App\Http\Requests\Api\User\SearchRequest;
use App\Http\Requests\Api\User\ShowRequest;
use App\Http\Requests\Api\User\UpdateProfileImageRequest;

class UserController extends Controller
{
    public function show(ShowRequest $request, $id)
    {
        return $request->run($id);
    }

    public function update(UpdateProfileImageRequest $request)
    {
        return $request->run();
    }

    public function destroy(DestroyRequest $request)
    {
        return $request->run();
    }

    public function changePassword(ChangePasswordRequest $request)
    {
        return $request->run();
    }

    public function imageUpdate(UpdateProfileImageRequest $request)
    {
        return $request->run();
    }
    public function search(SearchRequest $request){
        return $request->run();
    }
}
