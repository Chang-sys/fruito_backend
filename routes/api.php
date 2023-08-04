<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\AuthController;
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

Route::prefix('auth')->group(function(){
    Route::post('/login', [AuthController::class, 'authenticate']);
    Route::post('/register', [AuthController::class, 'register']);

});
Route::middleware('jwt.verify')->group(function(){
    Route::get('me',[AuthController::class,'get_user']);
    Route::post('logout', [AuthController::class,'logout']);
});


Route::group(['prefix' => 'customers'], function(){
    Route::get('/', [CustomerController::class, 'index']);
    Route::post('/', [CustomerController::class, 'store']);
    Route::get('/{id}', [CustomerController::class, 'show']);
    Route::get('/{id}/edit', [CustomerController::class, 'edit']);
    Route::put('/{id}/update', [CustomerController::class, 'update']);
    Route::delete('/{id}/delete', [CustomerController::class, 'destroy']);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
