<?php

use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\UserAuthController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::group(['prefix' => 'auth/user'], function () {
    Route::post('/login', [UserAuthController::class, 'login']);
    Route::post('/register', [UserAuthController::class, 'register']);
    Route::post('/logout', [UserAuthController::class, 'logout']);
    Route::get('/info', [UserAuthController::class, 'getUserInfo']);
});

Route::resources([
    'post' => PostController::class
], ['except' => ['create', 'edit']]);

