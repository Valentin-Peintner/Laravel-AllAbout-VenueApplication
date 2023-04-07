<?php

use App\Http\Controllers\ApiVenueController;
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


Route::group(['prefix' => '/venues', 'as' => 'venues.'], function () {
    Route::get('/', [ApiVenueController::class, 'index'])->name('index');
    Route::get('/{id}', [ApiVenueController::class, 'show'])->name('show');
});
