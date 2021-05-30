<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserAuthController;
use App\Http\Controllers\PostController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('login',[UserAuthController::class ,'login'])->name('login');
Route::get('register',[UserAuthController::class,'register']);
Route::post('create',[UserAuthController::class,'create'])->name('auth.create');
Route::post('check',[UserAuthController::class, 'check'])->name('auth.check');
Route::get('profile',[UserAuthController::class, 'profile'])->middleware('App\Http\Middleware\UserLogin');
Route::get('logout',[UserAuthController::class , 'logout']);


Route::prefix('/posts')->middleware('auth')->group(function () {
    Route::get('',[PostController::class,'index']);
    Route::post('',[PostController::class,'SendP'])->name('posts');
    Route::get('DeleteP/{id}',[PostController::class,'DeleteP']);
    Route::post('/Update',[PostController::class,'UpdateP'])->name('update');
    Route::get('Edit/{id}',[PostController::class,'EditP']);


});
