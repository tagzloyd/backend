<?php

use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
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

Route::controller(UserController::class)->group(function () {
    Route::get('/user', 'index');  // Get all users
    Route::get('/user/{id}', 'show');  // Show user by ID
    Route::post('/user', 'store');  // Store new user
    Route::put('/user/{id}', 'update');  // Update user by ID
    Route::delete('/user/{id}', 'destroy');  // Delete user by ID
});
Route::controller(TaskController::class)->group(function () {
    Route::get('/task', 'index');  // Get all tasks
    Route::get('/task/{id}', 'show');  // Show task by ID
    Route::post('/task', 'store');  // Store new task
    Route::put('/task/{id}', 'update');  // Update task by ID
    Route::delete('/task/{id}', 'destroy');  // Delete task by ID
});
