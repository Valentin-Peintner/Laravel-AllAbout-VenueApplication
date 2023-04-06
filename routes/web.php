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

Route::redirect('/', '/venues');

Route::get('/readme', function () {
    return view('readme');
});

Route::group(['prefix' => '/venues', 'as' => 'venues.'], function () {
    Route::get('/', [VenueController::class, 'index'])->name('index');
    Route::get('/create', [VenueController::class, 'create'])->name('create');
    Route::post('/', [VenueController::class, 'store'])->name('store');
    Route::get('/{venue}', [VenueController::class, 'show'])->name('show');
    Route::get('/{venue}/edit', [VenueController::class, 'edit'])->name('edit');
    Route::put('/{venue}', [VenueController::class, 'update'])->name('update');
    Route::delete('/{venue}', [VenueController::class, 'destroy'])->name('destroy');
});



