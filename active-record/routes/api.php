<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/fetch-twice', [\App\Http\Controllers\OrderController::class, 'fetchTwice']);
Route::get('/save-twice', [\App\Http\Controllers\OrderController::class, 'saveTwice']);
Route::get('/by-id-and-reference', [\App\Http\Controllers\OrderController::class, 'byReference']);
