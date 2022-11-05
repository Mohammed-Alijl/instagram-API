<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Follow\DestroyRequest;
use App\Http\Requests\Api\Follow\FollowersRequest;
use App\Http\Requests\Api\Follow\IndexRequest;
use App\Http\Requests\Api\Follow\SearchFollowerRequest;
use App\Http\Requests\Api\Follow\SearchFollowingRequest;
use App\Http\Requests\Api\Follow\ShowRequest;
use App\Http\Requests\Api\Follow\StoreRequest;

class FollowController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(IndexRequest $request,$id)
    {
        return $request->run($id);
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

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function followers(FollowersRequest $request, $id)
    {
        return $request->run($id);
    }

    public function searchFollowers(SearchFollowerRequest $request){
        return $request->run();
    }

    public function searchFollowing(SearchFollowingRequest $request){
        return $request->run();
    }

}
