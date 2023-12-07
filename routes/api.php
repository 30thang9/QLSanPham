<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProductApiController;

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


Route::get('/v1/product/list', [ProductApiController::class, 'productApiList']);
Route::post('/v1/product/add', [ProductApiController::class, 'productApiAdd']);
Route::post('/v1/product/edit/{id}', [ProductApiController::class, 'productApiEdit']);
Route::delete('/v1/product/delete/{id}', [ProductApiController::class, 'productApiDelete']);