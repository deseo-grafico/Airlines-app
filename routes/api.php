<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AirlinesController;

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

Route::get('/airlines', [AirlinesController::class, "showAll"]);
Route::get('/airlines/{id}', [AirlinesController::class, "showOne"]);
Route::post('/airline', [AirlinesController::class, "create"]);
Route::put('/airlines/{id}', [AirlinesController::class, "editName"]);

