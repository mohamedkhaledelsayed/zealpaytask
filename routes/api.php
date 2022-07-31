<?php

use App\Http\Controllers\Api\{BabyController, LoginController, ParnetController};
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
Route::post('login',[LoginController::class,'login']);

Route::resource('babies',BabyController::class)->middleware('auth:sanctum');
Route::resource('parents',ParnetController::class);
Route::post('bepartner',[ParnetController::class,'bepartner'])->middleware('auth:sanctum');
// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
