<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\V1\CategoryController;
use App\Http\Controllers\V1\UserController;

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
// 	return $request->user();
// });

Route::group(['prefix' => 'v1'], function () {
	// Categories end-points
	Route::get('categories', [CategoryController::class, 'index']);
	Route::get('categories/{id}', [CategoryController::class, 'show']);
	// Route::post('categories', [CategoryController::class, 'store']);

	// Users end-points
	Route::post('users', [UserController::class, 'store']);
});
