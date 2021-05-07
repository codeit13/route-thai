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


Route::middleware('auth')->group(function()
{

//wallet

Route::get('wallet/deposit/history',[App\Http\Controllers\TransactionController::class, 'index'])->name('wallet.deposit');

Route::get('/wallet/deposit',[App\Http\Controllers\TransactionController::class, 'create'])->name('wallet.deposit');

Route::get('/wallet/{type}/{typename?}',[App\Http\Controllers\TransactionController::class, 'show'])->name('wallet.history');


Route::post('/wallet/create/deposit/',[App\Http\Controllers\TransactionController::class, 'store'])->name('wallet.create.deposit');

});

Route::get('/wallet/p2p',[App\Http\Controllers\WalletController::class, 'index'])->name('wallet.p2p');

Route::get('/wallet/deposit',[App\Http\Controllers\WalletController::class, 'create'])->name('wallet.deposit');

Route::post('/wallet/create/deposit',[App\Http\Controllers\WalletController::class, 'store'])->name('wallet.create.deposit');

// OTP
Route::post('/mobile/otp/send',[App\Http\Controllers\HomeController::class, 'sendOTP'])->name('send.otp');
Route::post('/mobile/otp/verify',[App\Http\Controllers\HomeController::class, 'verifyOTP'])->name('verify.otp');

Route::post('/mobile/otp/send/login',[App\Http\Controllers\HomeController::class, 'sendOTPOnLogin'])->name('send.otp.login');

Route::post('/verify/register',[App\Http\Controllers\Auth\RegisterController::class, 'showOTPForm'])->name('otp.register');
