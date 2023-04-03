<?php

use App\Http\Controllers\VenueController;
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
    return view('venue.index');
});

Route::get('/readme', function () {
    return view('readme');
});

Route::get('/venue', [VenueController::class, 'index'])->name('venue.index');
Route::get('/venue/create', [VenueController::class, 'create'])->name('venue.create');
Route::post('/venue', [VenueController::class, 'store'])->name('venue.store');
Route::get('/venue/{venue}', [VenueController::class, 'show'])->name('venue.show');
Route::get('/venue/{venue}/edit', [VenueController::class, 'edit'])->name('venue.edit');
Route::put('/venue/{venue}', [VenueController::class, 'update'])->name('venue.update');
Route::delete('/venue/{venue}', [VenueController::class, 'destroy']);