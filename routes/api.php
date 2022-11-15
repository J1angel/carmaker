<?php

use App\Http\Controllers;
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

Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {

    Route::post('login', [Controllers\AuthController::class, 'login']);
    Route::post('logout', [Controllers\AuthController::class, 'logout']);
    Route::post('refresh', [Controllers\AuthController::class, 'refresh']);
    Route::post('me', [Controllers\AuthController::class, 'me']);

    Route::post('gettypes', [Controllers\TypeController::class, 'gettypes']);
    Route::post('addtypes', [Controllers\TypeController::class, 'addtypes']);
    Route::post('deletetypes', [Controllers\TypeController::class, 'deletetypes']);
});
