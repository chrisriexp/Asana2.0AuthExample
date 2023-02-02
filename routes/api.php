<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\tasksController;
use App\Http\Controllers\notesController;

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

Route::middleware('auth:sanctum')->get('/token/validate', [AuthController::class, 'tokenValidate']);

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);

/**Tasks */
Route::middleware('auth:sanctum')->get('/tasks', [tasksController::class, 'index']);
Route::prefix('/task')->group( function() {
    Route::post('/add', [tasksController::class, 'store']);
    Route::put('/update/{id}', [tasksController::class, 'update']);
});

/**Notes */
Route::get('/notes', [notesController::class, 'index']);
Route::prefix('/note')->group( function() {
    Route::post('/add', [notesController::class, 'store']);
    Route::put('/update/{id}', [notesController::class, 'update']);
    Route::delete('/delete/{id}', [notesController::class, 'destroy']);
});