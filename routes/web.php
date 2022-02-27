<?php

use App\Http\Controllers\ExperimentController;
use App\Http\Controllers\FieldController;
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

Route::get('/', function () {
    return view('welcome');
});
