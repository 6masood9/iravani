<?php


use App\Http\Controllers\Api\Postcontroller;
use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\TestApi;

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

Route::middleware('auth:api')->group(function () {
    Route::get('',[UserController::class,'getAllUsers']);
    Route::get('getposts',[Postcontroller::class,'getAllPosts']);
    Route::post('createpost',[Postcontroller::class,'createNewPost']);

    Route::get('logout',[UserController::class,'logout']);
});

Route::post('create',[UserController::class,'createNewUser']);
Route::post('login',[UserController::class,'login']);
