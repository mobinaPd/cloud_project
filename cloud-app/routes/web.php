<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/compareSel/{g1}/{g2}', [\App\Http\Controllers\ChartController::class, 'compareSel']);
Route::get('/totalSel/{t1}/{t2}', [\App\Http\Controllers\ChartController::class, 'totalSel']);
Route::get('/compareSelPublisher/{p1}/{p2}/{t1}/{t2}', [\App\Http\Controllers\ChartController::class, 'compareSelPublisher']);
Route::get('/compareSelGen/{t1}/{t2}', [\App\Http\Controllers\ChartController::class, 'compareSelGen']);



