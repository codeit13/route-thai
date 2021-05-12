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

Route::get('/createstoragelink', function () {
    Artisan::call('storage:link');
});


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Auth::routes(['verify'=>true,'request'=>true]);

// User Auth
Route::post('register/mobile-check',[App\Http\Controllers\Auth\RegisterController::class,'isMobileNoExist'])->name('mobile-check');
Route::post('register/email-check',[App\Http\Controllers\Auth\RegisterController::class,'isEmailExist'])->name('email-check');
Route::post('password/update', [App\Http\Controllers\HomeController::class, 'updatePassword'])->name('passwords.reset');
Route::post('password/reset', [App\Http\Controllers\HomeController::class, 'resetPassword'])->name('passwords.update');

// OTP
Route::post('/mobile/otp/send',[App\Http\Controllers\HomeController::class, 'sendOTP'])->name('send.otp');
Route::post('/mobile/otp/verify',[App\Http\Controllers\HomeController::class, 'verifyOTP'])->name('verify.otp');
Route::post('/mobile/otp/send/login',[App\Http\Controllers\HomeController::class, 'sendOTPOnLogin'])->name('send.otp.login');

Route::middleware('auth')->group(function(){    
    // Profile
    Route::prefix('user')->name('user.')->group(function(){ 
        Route::get('dashboard',[App\Http\Controllers\UserController::class, 'dashboard'])->name('dashboard');
    });
    
    //Wallet
    Route::prefix('wallet')->group(function(){
        Route::get('withdraw/history/{type?}/{typename?}',[App\Http\Controllers\TransactionController::class, 'withdraw_history'])->name('wallet.withdraw.history');
        Route::get('withdraw/{type?}/{typename?}/{currency?}/{currencyname?}',[App\Http\Controllers\TransactionController::class, 'create_withdraw'])->name('wallet.withdraw');
        Route::post('create/withdraw/',[App\Http\Controllers\TransactionController::class, 'store_withdraw'])->name('wallet.create.withdraw');
        Route::get('deposit/history/{type?}/{typename?}',[App\Http\Controllers\TransactionController::class, 'index'])->name('wallet.deposit.history');
        Route::get('deposit/{type?}/{typename?}/{currency?}/{currencyname?}',[App\Http\Controllers\TransactionController::class, 'create'])->name('wallet.deposit');
        Route::get('{type}/{typename?}',[App\Http\Controllers\TransactionController::class, 'show'])->name('wallet.history');
        Route::post('create/deposit/',[App\Http\Controllers\TransactionController::class, 'store'])->name('wallet.create.deposit');
    });
});

// Exchange
Route::get('p2p/exchange',function(){ return view('front.exchange'); })->name('p2p.exchange');

// Stocking
Route::get('staking',function() { return view('front.staking'); })->name('staking');