<?php

use App\Http\Controllers\Api\ApiAuthController;
use App\Http\Controllers\Api\ApiController;
use App\Http\Controllers\Api\V1\TaskController;
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
Route::get('/v1/health', [ApiController::class, 'health'])->name('health');

Route::group(['prefix' => 'auth'], function () {
    
    Route::controller(ApiAuthController::class)->group(function () {
        Route::post('login', 'login');
        Route::post('register', 'register');
        Route::post('logout', 'logout');
        Route::post('refresh', 'refresh');
    });
});

Route::apiResource('v1/tasks', TaskController::class);
Route::group(['prefix' => '/v1', 'controller' => TaskController::class], function () {
    Route::group(['prefix' => 'tasks', 'as' => 'tasks.'], function () {
        Route::patch('/{id}/{status}', 'updateStatus')->name('patch');
        Route::post('/{id}/attach-user/{userId}', 'attach')->name('attach.user');
    });
});
