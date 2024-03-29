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
Route::get('experiments/{experiment_id}/fields', [FieldController::class, 'index'])->middleware(['auth'])->name('experiments.fields.index');
Route::get('experiments/{experiment_id}/download-csv', [ExperimentController::class, 'downloadCsv'])->middleware(['auth'])->name('experiments.download-csv');
Route::get('experiments/{experiment_id}/download-csv/responses', [ExperimentController::class, 'downloadResponsesCsv'])->middleware(['auth'])->name('experiments.download-csv.responses');
Route::get('experiments/{experiment_id}/download-csv/fields', [ExperimentController::class, 'downloadFieldsCsv'])->middleware(['auth'])->name('experiments.download-csv.fields');
Route::post('experiments/{experiment_id}/fields', [FieldController::class, 'store'])->middleware(['auth'])->name('experiments.fields.store');
Route::delete('experiments/{experiment_id}/fields/{field_id}', [FieldController::class, 'destroy'])->middleware(['auth'])->name('experiments.fields.destroy');
Route::post('experiments/{experiment_id}/fields/sort', [FieldController::class, 'sort'])->middleware(['auth'])->name('fields.sort');
Route::post('experiments', [ExperimentController::class, 'store'])->middleware(['auth'])->name('experiments.store');
Route::put('experiments/{experiment_id}', [ExperimentController::class, 'update'])->middleware(['auth'])->name('experiments.update');

Route::get('experiments/{experiment_id}/participants/create', [ParticipantController::class, 'create'])->middleware(['auth'])->name('participants.create');
Route::post('experiments/{experiment_id}/participants', [ParticipantController::class, 'store'])->middleware(['auth'])->name('participants.store');
Route::get('participants/{participant_id}', [ParticipantController::class, 'show'])->middleware(['auth'])->name('participants.show');
Route::get('participants/{participant_id}/edit', [ParticipantController::class, 'edit'])->middleware(['auth'])->name('participants.edit');
Route::put('participants/{participant_id}', [ParticipantController::class, 'update'])->middleware(['auth'])->name('participants.update');
Route::delete('participants/{participant_id}', [ParticipantController::class, 'destroy'])->middleware(['auth'])->name('participants.destroy');

Route::get('users', [UserController::class, 'index'])->middleware(['auth'])->name('users.index');
Route::get('users/create', [UserController::class, 'create'])->middleware(['auth'])->name('users.create');
Route::post('users/store', [UserController::class, 'store'])->middleware(['auth'])->name('users.store');
Route::get('users/{user_id}/edit', [UserController::class, 'edit'])->middleware(['auth'])->name('users.edit');
Route::put('users/{user_id}', [UserController::class, 'update'])->middleware(['auth'])->name('users.update');
Route::put('users/{user_id}/password', [UserController::class, 'updatePassword'])->middleware(['auth'])->name('users.update-password');

Route::get('/', function () {
    return view('welcome');
});
