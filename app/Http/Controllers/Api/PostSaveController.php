<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\PostSave\DestroyRequest;
use App\Http\Requests\Api\PostSave\IndexRequest;
use App\Http\Requests\Api\PostSave\StoreRequest;
use Illuminate\Http\Request;

class PostSaveController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(IndexRequest $request)
    {
        return $request->run();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        return $request->run();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(DestroyRequest $request, $id)
    {
        return $request->run($id);
    }
}
