<?php

use App\Http\Controllers\{
    AuthController,
    StandardController
};
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/auth/google', [AuthController::class, 'redirectToProvider']);
Route::get('/auth/google/callback', [AuthController::class, 'handleGoogleCallback']);
Route::get('/auth/getToken/{email}', [AuthController::class, 'getToken']);


Route::group(['middleware' => ['jwt.verify']], function () {
    Route::get('/standard/all', [StandardController::class, 'all']);
    Route::post('/standard/create', [StandardController::class, 'create']);
    Route::put('/standard/update/{id}', [StandardController::class, 'update']);
    Route::put('/standard/saveComment/{id}', [StandardController::class, 'saveComment']);
});
