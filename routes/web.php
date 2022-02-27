<?php

use App\Http\Controllers\ExperimentController;
use App\Http\Controllers\FieldController;
use App\Http\Controllers\ParticipantController;
use App\Http\Controllers\UserController;
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

Route::resource('experiments', ExperimentController::class)->middleware(['auth']);
Route::post('experiments/{experiment_id}/fields', [FieldController::class, 'store'])->middleware(['auth'])->name('experiments.fields.store');
Route::delete('experiments/{experiment_id}/fields/{field_id}', [FieldController::class, 'destroy'])->middleware(['auth'])->name('experiments.fields.destroy');
Route::post('experiments/{experiment_id}/fields/sort', [FieldController::class, 'sort'])->middleware(['auth'])->name('fields.sort');
Route::post('experiments', [ExperimentController::class, 'store'])->middleware(['auth'])->name('experiments.store');
Route::put('experiments/{experiment_id}', [ExperimentController::class, 'update'])->middleware(['auth'])->name('experiments.update');

Route::get('experiments/{experiment_id}/participants/create', [ParticipantController::class, 'create'])->middleware(['auth'])->name('participants.create');
Route::post('experiments/{experiment_id}/participants', [ParticipantController::class, 'store'])->middleware(['auth'])->name('participants.store');
Route::get('participants/{participant_id}', [ParticipantController::class, 'show'])->middleware(['auth'])->name('participants.show');

Route::get('users', [UserController::class, 'index'])->middleware(['auth'])->name('users.index');
Route::get('users/create', [UserController::class, 'create'])->middleware(['auth'])->name('users.create');
Route::post('users/store', [UserController::class, 'store'])->middleware(['auth'])->name('users.store');

Route::get('/', function () {
    return view('welcome');
});
