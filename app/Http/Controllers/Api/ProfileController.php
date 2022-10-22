<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Profile\ProfilePostsRequest;
use App\Http\Requests\Api\Profile\ShowRequest;

class ProfileController extends Controller
{
    public function show(ShowRequest $request, $id)
    {
        return $request->run($id);
    }

    public function profilePosts(ProfilePostsRequest $request, $id)
    {
        return $request->run($id);
    }
}
