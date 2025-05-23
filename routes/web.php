<?php

use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::controller(TaskController::class)->group(function () {
    Route::get('/task', 'index');  // Get all tasks
    Route::get('/task/{id}', 'show');  // Show task by ID
    Route::post('/task', 'store');  // Store new task
    Route::put('/task/{id}', 'update');  // Update task by ID
    Route::delete('/task/{id}', 'destroy');  // Delete task by ID
});
