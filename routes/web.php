<?php

use App\Http\Controllers\BlacklistController;
use App\Models\Blacklist;
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

Route::get('/', [BlacklistController::class, 'index'])->name('main');

Route::name('blacklist.')->group(function () {
    Route::post('/add', [BlacklistController::class, 'store'])->name('add');
    Route::post('/show', [BlacklistController::class, 'show'])->name('show');
});
