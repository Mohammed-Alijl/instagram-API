<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Search\DestroyRequest;
use App\Http\Requests\Api\Search\IndexRequest;
use App\Http\Requests\Api\Search\SearchRequest;
use App\Http\Requests\Api\Search\StoreRequest;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(IndexRequest $request)
    {
        return $request->run();
    }

    public function store(StoreRequest $request)
    {
        return $request->run();
    }

    public function destroy(DestroyRequest $request, $id)
    {
        return $request->run($id);
    }

    public function search(SearchRequest $request)
    {
        return $request->run();
    }
}
