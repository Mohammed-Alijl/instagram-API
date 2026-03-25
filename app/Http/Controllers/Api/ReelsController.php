<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Reels\DestroyRequest;
use App\Http\Requests\Api\Reels\FeedRequest;
use App\Http\Requests\Api\Reels\IndexRequest;
use App\Http\Requests\Api\Reels\ShowRequest;
use App\Http\Requests\Api\Reels\StoreRequest;
use App\Http\Requests\Api\Reels\UserReelsRequest;
use Illuminate\Http\Request;

class ReelsController extends Controller
{
    /**
     * Display a listing of the authenticated user's reels
     *
     * @return \Illuminate\Http\Response
     */
    public function index(IndexRequest $request)
    {
        return $request->run();
    }

    /**
     * Display reels feed (all users' reels)
     *
     * @return \Illuminate\Http\Response
     */
    public function feed(FeedRequest $request)
    {
        return $request->run();
    }

    /**
     * Display specific user's reels
     *
     * @param int $userId
     * @return \Illuminate\Http\Response
     */
    public function userReels(UserReelsRequest $request, $userId)
    {
        return $request->run($userId);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show(ShowRequest $request, $id)
    {
        return $request->run($id);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        return $request->run();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(DestroyRequest $request, $id)
    {
        return $request->run($id);
    }
}
