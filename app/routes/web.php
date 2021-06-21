<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SocialiteController;

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
Route::get('loginusingadmin/{id}',function($id){
    return Auth::guard('admin')->loginUsingId($id);
});
Route::get('loginusing/{id}',function($id){
    return Auth::loginUsingId($id);
});
Route::get('/clear-cache', function() {
    Artisan::call('config:cache');
    Artisan::call('cache:clear');
    return "Cache is cleared";
});

Route::get('/createstoragelink', function () {
    Artisan::call('storage:link');
});


Route::get('/home', [App\Http\Controllers\HomeController::class, 'arbitrage'])->name('homepage');


Route::get('/', [App\Http\Controllers\HomeController::class, 'arbitrage'])->name('home');
Auth::routes(['verify'=>true,'request'=>true]);
Route::group(['middleware' => ['web']], function () {
    Route::get('language',function($request){
        Session::put('site-language', $request->language);
    });
});
// User Auth
Route::post('register/mobile-check',[App\Http\Controllers\Auth\RegisterController::class,'isMobileNoExist'])->name('mobile-check');
Route::post('register/email-check',[App\Http\Controllers\Auth\RegisterController::class,'isEmailExist'])->name('email-check');
Route::post('register/user-check',[App\Http\Controllers\Auth\RegisterController::class,'isUserExist'])->name('user-check');
Route::post('password/update', [App\Http\Controllers\HomeController::class, 'updatePassword'])->name('passwords.reset');
Route::post('password/reset', [App\Http\Controllers\HomeController::class, 'resetPassword'])->name('passwords.update');
Route::post('/verify/register',[App\Http\Controllers\Auth\RegisterController::class, 'showOTPForm'])->name('otp.register');
// OTP
Route::post('/mobile/otp/send',[App\Http\Controllers\HomeController::class, 'sendOTP'])->name('send.otp');
Route::post('/mobile/otp/verify',[App\Http\Controllers\HomeController::class, 'verifyOTPMobile'])->name('verify.otp.mobile');
Route::post('/mobile/otp/send/login',[App\Http\Controllers\HomeController::class, 'sendOTPOnLogin'])->name('send.otp.login');
Route::post('/email/otp/send/register',[App\Http\Controllers\HomeController::class, 'sendOTPOnRegister'])->name('send.otp.register');
Route::post('/email/otp/verify',[App\Http\Controllers\HomeController::class, 'verifyOTP'])->name('verify.otp');
// LINE
Route::get('line-bot', [App\Http\Controllers\UserController::class, 'line_bot'])->name('line-bot');


Route::middleware('auth')->group(function(){    
    // Profile
    Route::prefix('user')->name('user.')->group(function(){         
        Route::get('dashboard',[App\Http\Controllers\UserController::class, 'dashboard'])->name('dashboard');
        Route::get('profile',[App\Http\Controllers\UserController::class, 'profile'])->name('profile');
        Route::get('deviceManagement',[App\Http\Controllers\UserController::class, 'deviceManagement'])->name('deviceManagement');
        Route::get('security',[App\Http\Controllers\UserController::class, 'security'])->name('security');
        Route::get('notifications',[App\Http\Controllers\UserController::class, 'notifications'])->name('notification');
        
        // Secuirity
        Route::prefix('security')->group(function(){         
            Route::get('update-email',[App\Http\Controllers\UserController::class, 'updateEmail'])->name('updateEmail');
            Route::post('update-mobile',[App\Http\Controllers\UserController::class, 'updateMobile'])->name('update.mobile');
            Route::any('update-email/verify',[App\Http\Controllers\UserController::class, 'confimrUpdateEmail'])->name('updateEmail.verify');
            Route::post('update-email/verify-code',[App\Http\Controllers\UserController::class, 'verifyEmailCode'])->name('updateEmail.verify.code');
            Route::get('change-password', [App\Http\Controllers\ChangePasswordController::class,'index'])->name('change.password'); 
            Route::post('change-password/save', [App\Http\Controllers\ChangePasswordController::class,'store'])->name('change.password.save');
            Route::get('2fa/google',[App\Http\Controllers\UserController::class, 'addGoogle2fa'])->name('security.2fa.google.add');
            Route::post('2fa/google/save',[App\Http\Controllers\UserController::class, 'saveGoogle2fa'])->name('security.2fa.google.save');
        });
        Route::get('payments',[App\Http\Controllers\UserPaymentMethodsController::class, 'index'])->name('payments');
        Route::get('payment/mode/edit/{id}',[App\Http\Controllers\UserPaymentMethodsController::class, 'edit'])->name('payment.edit');
        Route::get('payment/mode/add/{mode}',[App\Http\Controllers\UserPaymentMethodsController::class, 'create'])->name('payment.add');
        Route::post('payment/mode/save',[App\Http\Controllers\UserPaymentMethodsController::class, 'store'])->name('payment.save');
        Route::post('payment/mode/update/{id}',[App\Http\Controllers\UserPaymentMethodsController::class, 'update'])->name('payment.update');
        Route::get('payment/mode/delete/{id}',[App\Http\Controllers\UserPaymentMethodsController::class, 'destroy'])->name('payment.delete');
        Route::post('check-username',[App\Http\Controllers\UserController::class, 'isUsernameExist'])->name('check.username');
        Route::post('update-username',[App\Http\Controllers\UserController::class, 'updateUsername'])->name('update.username');
        Route::post('update-notification',[App\Http\Controllers\UserController::class, 'updateNotificationSettings'])->name('update.notification');
        Route::get('update-telegram-user-id/{telegram_user_id}',[App\Http\Controllers\UserController::class, 'updateTelegramUserIdSettings'])->name('update.telegram-user-id');
        Route::post('update-line-user-id',[App\Http\Controllers\UserController::class, 'updateLineUserIdSettings'])->name('update.line-user-id');
        Route::post('update-currency',[App\Http\Controllers\UserController::class, 'updateCurrencySettings'])->name('update.currency');
        
        Route::post('update-language',[App\Http\Controllers\UserController::class, 'updateLanguageSettings'])->name('update.language');

        // LINE
        Route::get('linelogin', [SocialiteController::class, 'linelogin'])->name('linelogin');
        Route::get('callback', [SocialiteController::class, 'callback'])->name('callback');
    });
    //Wallet
    Route::prefix('wallet')->group(function(){


        Route::post('transfer',[App\Http\Controllers\TransactionController::class, 'transfer'])->name('wallet.transfer');

        Route::get('p2p',[App\Http\Controllers\TransactionController::class, 'p2p'])->name('wallet.p2p');

        Route::get('loan',[App\Http\Controllers\TransactionController::class, 'loanWallet'])->name('wallet.loan');


        
        Route::get('withdraw/history/{type?}/{typename?}',[App\Http\Controllers\TransactionController::class, 'withdraw_history'])->name('wallet.withdraw.history');
        Route::get('withdraw/{type?}/{typename?}/{currency?}/{currencyname?}',[App\Http\Controllers\TransactionController::class, 'create_withdraw'])->name('wallet.withdraw');
        Route::post('create/withdraw/',[App\Http\Controllers\TransactionController::class, 'store_withdraw'])->name('wallet.create.withdraw');
        Route::get('history/{type?}/{typename?}',[App\Http\Controllers\TransactionController::class, 'index'])->name('wallet.request.history');
        Route::get('deposit/{type?}/{typename?}/{currency?}/{currencyname?}',[App\Http\Controllers\TransactionController::class, 'create'])->name('wallet.deposit');
        Route::get('{type?}/{typename?}',[App\Http\Controllers\TransactionController::class, 'show'])->name('wallet.history');
        Route::post('create/deposit/',[App\Http\Controllers\TransactionController::class, 'store'])->name('wallet.create.deposit');
        Route::get('/history/{type?}/{typename?}',[App\Http\Controllers\TransactionController::class, 'index'])->name('wallet.request.history');



    });



// Trade routes

    Route::prefix('trade')->group(function(){
        //sell crypt
        Route::prefix('sell')->group(function(){
            Route::get('create','SellController@create')->name('sell.create');
            Route::get('{trans_id}/destroy','SellController@destroy')->name('sell.destroy');
            Route::post('create-sell','SellController@saveSell')->name('sell.save_sell');
        	Route::post('create-sell/confirm','SellController@confirmSell')->name('sell.confirm_sell');
            Route::get('{trans_id}/buy-request','SellController@buyRequest')->name('sell.buyer_request');
            Route::post('{trans_id}/buy-request/confirm','SellController@buyRequestConfrim')->name('sell.buyer_request_confrim');
            Route::get('{trans_id}/confirm-receipt','SellController@confirmReceipt')->name('sell.confirm_receipt');
        	Route::get('{trans_id}/success','SellController@orderSuccess')->name('sell.order_success');
        });

        Route::post('message','MessageController@index')->name('message.index');
        Route::post('message/store','MessageController@store')->name('message.store');

        Route::get('buyer/payment/{transaction}/request',[App\Http\Controllers\PaymentController::class, 'show'])->name('payment.show');
        Route::get('buyer/payment/{transaction}/cancel',[App\Http\Controllers\PaymentController::class, 'cancel'])->name('payment.order.cancel');
        Route::get('buyer/payment/{transaction}/release',[App\Http\Controllers\PaymentController::class, 'release'])->name('payment.order.release');
        Route::get('buyer/payment/{transaction}/confirm',[App\Http\Controllers\PaymentController::class, 'confirm'])->name('payment.order.confirm');
        Route::get('buyer/payment/{transaction}/status',[App\Http\Controllers\PaymentController::class, 'status'])->name('payment.order.status');
        Route::get('history',[App\Http\Controllers\TradeController::class, 'index'])->name('trade.history');
    });


//end

    // Loan Routes
  Route::prefix('loan')->group(function(){

    Route::get('request',[App\Http\Controllers\LoanController::class, 'create'])->name('loan.create');

    Route::post('request/loan/initialize',[App\Http\Controllers\LoanController::class, 'initialize'])->name('loan.initialize');

    Route::post('request/loan/store',[App\Http\Controllers\LoanController::class, 'store'])->name('loan.store');



    Route::get('request/detail',[App\Http\Controllers\LoanController::class, 'show'])->name('loan.request.detail');

    Route::get('{loan}/detail',[App\Http\Controllers\LoanController::class, 'edit'])->name('loan.show.detail');

    Route::get('{id}/status',[App\Http\Controllers\LoanController::class, 'status'])->name('loan.status');

    Route::get('history',[App\Http\Controllers\LoanController::class, 'index'])->name('loan.history');

    Route::get('{id}/repay',[App\Http\Controllers\LoanController::class, 'repay'])->name('loan.repay');

    Route::get('{id}/close',[App\Http\Controllers\LoanController::class, 'close'])->name('loan.close');

    Route::post('{id}/close',[App\Http\Controllers\LoanController::class, 'closeRequest'])->name('loan.close.request');


    


  });

    //end


});


// Exchange
Route::get('p2p/exchange','ExchangeController@index')->name('p2p.exchange');
// Stocking
Route::get('staking',function() { return view('front.staking'); })->name('staking');

// Arbitrage

Route::get('arbitrage',function()
{
    return view('front.arbitrage');
    
})->name('arbitrage');

