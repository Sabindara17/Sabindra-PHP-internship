<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\APIController;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group(['middleware'=>['auth:api']], function(){
    Route::group(['prefix'=>'post'],function(){
        Route::get('/', [\App\Http\Controllers\APIController::class, 'index']);
        Route::post('/', [\App\Http\Controllers\APIController::class, 'store']);
        Route::patch('/{post}', [\App\Http\Controllers\APIController::class, 'update']);
        Route::delete('/{post}', [\App\Http\Controllers\APIController::class, 'destroy']);
    });
});

Route::post('login',[APIController::class,'login']);
