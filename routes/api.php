<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Movies;

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

Route::post('/movie', [Movies::class, 'create']);
Route::get('/movie', [Movies::class, 'get']);
Route::get('/movie/{id}', [Movies::class, 'getById']);
Route::put('/movie/{id}', [Movies::class, 'update']);
Route::delete('/movie/{id}', [Movies::class, 'delete']);
