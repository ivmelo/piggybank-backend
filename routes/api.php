<?php

use App\Http\Controllers\ParticipantController;
use App\Http\Controllers\ResponseController;
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

Route::post('/participants/authenticate', [ParticipantController::class, 'authenticateExperiment'])->name('participants.authenticate');
Route::post('/responses', [ResponseController::class, 'store'])->name('responses.store');

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
