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
Auth::routes(['verify'=>true,'request'=>true]);
Route::post('register/mobile-check',[App\Http\Controllers\Auth\RegisterController::class,'isMobileNoExist'])->name('mobile-check');
Route::post('register/email-check',[App\Http\Controllers\Auth\RegisterController::class,'isEmailExist'])->name('email-check');
Route::post('password/update', [App\Http\Controllers\HomeController::class, 'updatePassword'])->name('passwords.reset');
Route::post('password/reset', [App\Http\Controllers\HomeController::class, 'resetPassword'])->name('passwords.update');
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware('auth')->group(function()
{
	//wallet
	Route::get('wallet/withdraw/history/{type?}/{typename?}',[App\Http\Controllers\TransactionController::class, 'withdraw_history'])->name('wallet.withdraw.history');
	Route::get('wallet/withdraw/{type?}/{typename?}/{currency?}/{currencyname?}',[App\Http\Controllers\TransactionController::class, 'create_withdraw'])->name('wallet.withdraw');
	Route::post('wallet/create/withdraw/',[App\Http\Controllers\TransactionController::class, 'store_withdraw'])->name('wallet.create.withdraw');
	Route::get('wallet/deposit/history/{type?}/{typename?}',[App\Http\Controllers\TransactionController::class, 'index'])->name('wallet.deposit.history');
	Route::get('wallet/deposit/{type?}/{typename?}/{currency?}/{currencyname?}',[App\Http\Controllers\TransactionController::class, 'create'])->name('wallet.deposit');
	Route::get('wallet/{type}/{typename?}',[App\Http\Controllers\TransactionController::class, 'show'])->name('wallet.history');
	Route::post('wallet/create/deposit/',[App\Http\Controllers\TransactionController::class, 'store'])->name('wallet.create.deposit');

	//sell crypt
	Route::get('sell/create','SellController@create')->name('sell.create');
	Route::post('sell','SellController@saveSell')->name('sell.save_sell');
	Route::get('sell/{trans_id}/edit','SellController@edit')->name('sell.edit');
});

// OTP
Route::post('/mobile/otp/send',[App\Http\Controllers\HomeController::class, 'sendOTP'])->name('send.otp');
Route::post('/mobile/otp/verify',[App\Http\Controllers\HomeController::class, 'verifyOTP'])->name('verify.otp');
Route::post('/mobile/otp/send/login',[App\Http\Controllers\HomeController::class, 'sendOTPOnLogin'])->name('send.otp.login');
// Exchange
Route::get('p2p/exchange',function()
{
	return view('front.exchange');
})->name('p2p.exchange');

// Staking
Route::get('staking',function()
{
	return view('front.staking');
})->name('staking');

Route::post('/verify/register',[App\Http\Controllers\Auth\RegisterController::class, 'showOTPForm'])->name('otp.register');