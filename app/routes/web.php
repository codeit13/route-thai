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
Route::group(['middleware' => ['web']], function () {
    Route::get('language',function($request){
        Session::put('site-language', $request->language);
    });
});
// User Auth
Route::post('register/mobile-check',[App\Http\Controllers\Auth\RegisterController::class,'isMobileNoExist'])->name('mobile-check');
Route::post('register/email-check',[App\Http\Controllers\Auth\RegisterController::class,'isEmailExist'])->name('email-check');
Route::post('password/update', [App\Http\Controllers\HomeController::class, 'updatePassword'])->name('passwords.reset');
Route::post('password/reset', [App\Http\Controllers\HomeController::class, 'resetPassword'])->name('passwords.update');
Route::post('/verify/register',[App\Http\Controllers\Auth\RegisterController::class, 'showOTPForm'])->name('otp.register');
// OTP
Route::post('/mobile/otp/send',[App\Http\Controllers\HomeController::class, 'sendOTP'])->name('send.otp');
Route::post('/mobile/otp/verify',[App\Http\Controllers\HomeController::class, 'verifyOTP'])->name('verify.otp');
Route::post('/mobile/otp/send/login',[App\Http\Controllers\HomeController::class, 'sendOTPOnLogin'])->name('send.otp.login');

Route::middleware('auth')->group(function(){
    
    // Profile
    Route::prefix('user')->name('user.')->group(function(){ 
        Route::get('dashboard',[App\Http\Controllers\UserController::class, 'dashboard'])->name('dashboard');
        Route::get('profile',[App\Http\Controllers\UserController::class, 'profile'])->name('profile');
        Route::get('payments',[App\Http\Controllers\UserPaymentMethodsController::class, 'index'])->name('payments');
        Route::get('payment/mode/edit/{id}',[App\Http\Controllers\UserPaymentMethodsController::class, 'edit'])->name('payment.edit');
        Route::get('payment/mode/add/{mode}',[App\Http\Controllers\UserPaymentMethodsController::class, 'create'])->name('payment.add');
        Route::post('payment/mode/save',[App\Http\Controllers\UserPaymentMethodsController::class, 'store'])->name('payment.save');
        Route::post('payment/mode/update/{id}',[App\Http\Controllers\UserPaymentMethodsController::class, 'update'])->name('payment.update');
        Route::get('payment/mode/delete/{id}',[App\Http\Controllers\UserPaymentMethodsController::class, 'destroy'])->name('payment.delete');
        Route::post('check-username',[App\Http\Controllers\UserController::class, 'isUsernameExist'])->name('check.username');
        Route::post('update-username',[App\Http\Controllers\UserController::class, 'updateUsername'])->name('update.username');
        Route::post('update-notification',[App\Http\Controllers\UserController::class, 'updateNotificationSettings'])->name('update.notification');
        Route::post('update-currency',[App\Http\Controllers\UserController::class, 'updateCurrencySettings'])->name('update.currency');
        Route::post('update-language',[App\Http\Controllers\UserController::class, 'updateLanguageSettings'])->name('update.language');
    });
    
    //Wallet
    Route::prefix('wallet')->group(function(){
        Route::get('withdraw/history/{type?}/{typename?}',[App\Http\Controllers\TransactionController::class, 'withdraw_history'])->name('wallet.withdraw.history');
        Route::get('withdraw/{type?}/{typename?}/{currency?}/{currencyname?}',[App\Http\Controllers\TransactionController::class, 'create_withdraw'])->name('wallet.withdraw');
        Route::post('create/withdraw/',[App\Http\Controllers\TransactionController::class, 'store_withdraw'])->name('wallet.create.withdraw');
        Route::get('history/{type?}/{typename?}',[App\Http\Controllers\TransactionController::class, 'index'])->name('wallet.request.history');
        Route::get('deposit/{type?}/{typename?}/{currency?}/{currencyname?}',[App\Http\Controllers\TransactionController::class, 'create'])->name('wallet.deposit');
        Route::get('{type}/{typename?}',[App\Http\Controllers\TransactionController::class, 'show'])->name('wallet.history');
        Route::post('create/deposit/',[App\Http\Controllers\TransactionController::class, 'store'])->name('wallet.create.deposit');
        Route::get('wallet/deposit/history/{type?}/{typename?}',[App\Http\Controllers\TransactionController::class, 'index'])->name('wallet.request.history');
    });


// Trade routes

    Route::prefix('trade')->group(function(){



Route::get('buyer/payment/{transaction}/request',[App\Http\Controllers\PaymentController::class, 'show'])->name('payment.show');

Route::get('buyer/payment/{transaction}/cancel',[App\Http\Controllers\PaymentController::class, 'cancel'])->name('payment.order.cancel');

Route::get('buyer/payment/{transaction}/release',[App\Http\Controllers\PaymentController::class, 'release'])->name('payment.order.release');

Route::get('buyer/payment/{transaction}/confirm',[App\Http\Controllers\PaymentController::class, 'confirm'])->name('payment.order.confirm');

Route::get('buyer/payment/{transaction}/status',[App\Http\Controllers\PaymentController::class, 'status'])->name('payment.order.status');

Route::get('history',[App\Http\Controllers\TradeController::class, 'index'])->name('trade.history');


});


//end


});




// Exchange
Route::get('p2p/exchange',function(){ return view('front.exchange'); })->name('p2p.exchange');

// Stocking
Route::get('staking',function() { return view('front.staking'); })->name('staking');



