<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\User\BucketController;
use App\Http\Controllers\User\BucketItemController;
use Illuminate\Http\Request;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('v1')->group(function () {
    Route::post('signup',[AuthController::class, 'signup']);
    Route::post('login',[AuthController::class, 'login']);

    Route::prefix('admin')->group(function () {
        Route::resource('categories',CategoryController::class);
    });

    Route::prefix('user')->group(function () {
        Route::resource('buckets',BucketController::class);
        Route::resource('bucket-items',BucketItemController::class);
    });
});