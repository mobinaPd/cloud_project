<?php

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('/games', [\App\Http\Controllers\GameController::class, 'index']);
Route::get('/rank/{rank}', [\App\Http\Controllers\GameController::class, 'rank']);
// Route::get('/name/{name}', [\App\Http\Controllers\GameController::class, 'name']);
// Route::get('/bestgameplat/{N}', [\App\Http\Controllers\GameController::class, 'bestGamePlat']);
// Route::get('/bestgameyear/{N}', [\App\Http\Controllers\GameController::class, 'bestGameYear']);
// Route::get('/bestgamegenre/{N}', [\App\Http\Controllers\GameController::class, 'bestGameGen']);
// Route::get('/best5/{year , plat}', [\App\Http\Controllers\GameController::class, 'best5']);
// Route::get('/euMoreNa', [\App\Http\Controllers\GameController::class, 'euMoreNa']);

