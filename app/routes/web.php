<?php

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

Route::get('/clear-cache', function() {
    Artisan::call('config:cache');
    Artisan::call('cache:clear');
    return "Cache is cleared";
});


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes(['verify'=>true]);

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/wallet/p2p',[App\Http\Controllers\TransactionController::class, 'index'])->name('wallet.p2p');

Route::get('/wallet/deposit',[App\Http\Controllers\TransactionController::class, 'create'])->name('wallet.deposit');

Route::post('/wallet/create/deposit/',[App\Http\Controllers\TransactionController::class, 'store'])->name('wallet.create.deposit');
