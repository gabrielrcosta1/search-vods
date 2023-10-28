<?php

use App\Http\Controllers\ChannelController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\SerieController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', MovieController::class)->name('movies');
Route::get('/series', SerieController::class)->name('series');