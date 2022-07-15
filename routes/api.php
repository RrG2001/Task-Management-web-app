<?php

use App\Http\Controllers\ProjectController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'users'], function (){
    Route::post('/create', [\App\Http\Controllers\UsersController::class, 'store']);
    Route::get('/{userId}/read', [\App\Http\Controllers\UsersController::class, 'read']);
    Route::delete('/{userId}/delete', [\App\Http\Controllers\UsersController::class, 'delete']);
    Route::post('/register', [\App\Http\Controllers\UsersController::class, 'register']);
    Route::post('/login', [\App\Http\Controllers\UsersController::class, 'login']);
    Route::post('/resetPassword', [\App\Http\Controllers\UsersController::class, 'resetPassword']);
});

Route::group(['prefix' => 'tasks'], function (){
    Route::post('/create', [\App\Http\Controllers\TaskController::class, 'store']);
    Route::get('/{taskId}/read', [\App\Http\Controllers\TaskController::class, 'read']);
    Route::patch('/{taskId}/update', [\App\Http\Controllers\TaskController::class, 'update']);
    Route::delete('/{taskId}/delete', [\App\Http\Controllers\TaskController::class, 'delete']);
});

Route::group(['prefix' => 'projects'], function (){
    Route::post('/create', [\App\Http\Controllers\ProjectController::class, 'store']);
    Route::get('/{projectId}/read', [\App\Http\Controllers\ProjectController::class, 'read']);
    Route::get('{projectId}/tasks', [\App\Http\Controllers\ProjectController::class, 'getAll']);
    Route::get('{projectId}/status', [\App\Http\Controllers\ProjectController::class, 'getStatus']);
    Route::get('{projectId}/priority', [\App\Http\Controllers\ProjectController::class, 'getPriority']);
    Route::get('{projectId?}/sort', [\App\Http\Controllers\ProjectController::class, 'sortProjectUsers']);
    Route::patch('/{projectId}/update', [\App\Http\Controllers\ProjectController::class, 'update']);
    Route::delete('/{projectId}/delete', [\App\Http\Controllers\ProjectController::class, 'delete']);
    Route::get('/project', [\App\Http\Controllers\ProjectController::class,'read']);
});
