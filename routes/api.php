<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\SessionController;

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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::prefix('v1')->group(function () {
	Route::post('register', [AuthController::class, 'register']);
	Route::post('login', [AuthController::class, 'login']);
	
	Route::middleware('auth:api')->group(function () {
		Route::softDeletes('users', UserController::class);
		Route::apiResource('users', UserController::class);

		Route::softDeletes('posts', PostController::class);
		Route::apiResource('posts', PostController::class);

		// Route::apiResource('sessions', SessionController::class);
		Route::get('sessions', [SessionController::class, 'index'])->name('sessions.index');
		Route::post('sessions/log', [SessionController::class, 'log'])->name('sessions.log');
	});
});