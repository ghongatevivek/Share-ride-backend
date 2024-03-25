<?php

use App\Http\Controllers\Api\{DriverController, LoginController};
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

Route::post('login', [LoginController::class, 'login']);
Route::post('login/verify', [LoginController::class, 'loginVerify']);

Route::group(['middleware' => 'auth:sanctum'], function(){
    Route::get('driver', [DriverController::class, 'show']);
    Route::post('driver', [DriverController::class,'update']);

    Route::get('/user', function(Request $request){
        return $request->user();
    });
});
