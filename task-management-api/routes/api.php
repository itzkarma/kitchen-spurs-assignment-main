<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\TaskController;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// signup and login
Route::controller(AuthController::class)->group(function(){
    // Route::get('auth/test', 'test');
    Route::post('auth/register', 'register');
    Route::post('auth/login', 'login');
});

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::controller(AuthController::class)->group(function(){
        // Route::get('auth/test', 'test');
        Route::get('auth/user', 'user');
        Route::post('auth/logout', 'logout');
    });

    // Route::get('tasks/test', [TaskController::class, 'test']);
    Route::get('tasks/assigned-to-me', [TaskController::class, 'tasksAssignedToCurrentUser']);
    Route::resource('tasks', TaskController::class);
    Route::post('tasks/{task}/assign-users', [TaskController::class, 'assignUsers']);
    Route::post('tasks/{task}/unassign-user', [TaskController::class, 'unassignUser']);
    Route::post('tasks/{task}/change-status', [TaskController::class, 'changeStatus']);
    Route::get('tasks/user/{user}', [TaskController::class, 'tasksAssignedToUser']);
});
