<?php

use App\Http\Controllers\AnswersController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
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

Route::post('/register', [AuthController::class, 'register']);

Route::get('/search/{title}', [PostController::class, 'search']);
Route::post('/login', [AuthController::class, 'login']);

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::put('/user/{id}', [AuthController::class, 'update']);
    Route::get('/users', [AuthController::class, 'users']);
    Route::get('/delete/{id}', [AuthController::class, 'destroy']);
    Route::get('/userinfo/{id}', [AuthController::class, 'user']);
    Route::get('/user/{user_id}', [PostController::class, 'userPosts']);
    Route::get('/ans', [PostController::class, 'answers']);
    Route::get('/answers/{id}', [AnswersController::class, 'show']);
    Route::get('/logout', [AuthController::class, 'logout']);
    Route::get('/', [PostController::class, 'index']);
    Route::get('/{id}', [PostController::class, 'show']);
    Route::put('/{id}', [PostController::class, 'update']);
    Route::post('/create', [PostController::class, 'store']);
    Route::delete('/post/{id}', [PostController::class, 'destroy']);
    Route::delete('/answer/{id}', [AnswersController::class, 'destroy']);

    //TODO Answers :

    Route::post('/answers/create', [AnswersController::class, 'store']);
});
