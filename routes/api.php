<?php

use App\Http\Controllers\Api\{DriverController, LoginController, TripController};
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
    // Driver routes
    Route::get('driver', [DriverController::class, 'show']);
    Route::post('driver', [DriverController::class,'update']);

    // Trip Routes 
    Route::get('trip/{trip}', [TripController::class, 'show']);
    Route::post('trip', [TripController::class,'update']);

    Route::get('/user', function(Request $request){
        return $request->user();
    });
});
