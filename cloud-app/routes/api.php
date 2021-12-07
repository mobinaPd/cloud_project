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

Route::get('/games', [\App\Http\Controllers\GameController::class, 'index'])->middleware('auth:sanctum');
Route::get('/rank/{rank}', [\App\Http\Controllers\GameController::class, 'rank'])->middleware('auth:sanctum');
Route::get('/name/{name}', [\App\Http\Controllers\GameController::class, 'name'])->middleware('auth:sanctum');
Route::get('/bestgameplat/{N}', [\App\Http\Controllers\GameController::class, 'bestGamePlat'])->middleware('auth:sanctum');
Route::get('/bestgameyear/{N}', [\App\Http\Controllers\GameController::class, 'bestGameYear'])->middleware('auth:sanctum');
Route::get('/bestgamegenre/{N}', [\App\Http\Controllers\GameController::class, 'bestGameGen'])->middleware('auth:sanctum');
Route::get('/best5/{year}/{plat}', [\App\Http\Controllers\GameController::class, 'best5'])->middleware('auth:sanctum');
Route::get('/euMoreNa', [\App\Http\Controllers\GameController::class, 'euMoreNa'])->middleware('auth:sanctum');
Route::post('/register', [\App\Http\Controllers\AuthController::class, 'register']);
Route::post('/login', [\App\Http\Controllers\AuthController::class, 'login']);
Route::post('/logout', [\App\Http\Controllers\AuthController::class, 'logout'])->middleware('auth:sanctum');
