<?php

Route::prefix('admin')->name('admin.')->namespace('Admin')->middleware('guest:admin')->group(function () {

    Route::get('/', 'Auth\LoginController@showLoginForm')->name('loginpage');
    Route::get('login', 'Auth\LoginController@showLoginForm')->name('auth');
    Route::post('logout', 'Auth\LoginController@logout')->name('logout');
    Route::post('login', 'Auth\LoginController@login')->name('login');
    Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
    Route::post('register', 'Auth\RegisterController@register')->name('register');

    Route::middleware(['auth:admin'])->group(function () {
        Route::get('dashboard', 'DashboardController@index')->name('dashboard');
        //Wallet
        Route::get('trades','TransactionController@index')->name('trades.list');
        Route::get('trade/{id}/details','TransactionController@view')->name('trade.show');
        Route::post('trade/update/status','TransactionController@updateStatus')->name('trade.update.status');
        Route::get('deposit/requests/{type}/{name}','TransactionController@show')->name('deposit.requests.show');
        Route::get('withdraw/requests/{type?}/{name?}','TransactionController@show_withdraw')->name('withdraw.requests.show');
        Route::get('wallet/{type}/{transaction}/change/status/{status}','TransactionController@changeStatus')->name('wallet.change.status');

        Route::get('user/wallets','WalletController@index')->name('user.wallets');

        Route::get('deposit/address','DepositAddressController@index')->name('deposit.address');

        Route::post('deposit/address/create','DepositAddressController@store')->name('deposit.address.create');

        Route::get('deposit/address/{deposit_address}/edit','DepositAddressController@edit')->name('deposit.address.edit');

        Route::get('deposit/address/{deposit_address}/delete','DepositAddressController@destroy')->name('deposit.address.delete');

        Route::put('deposit/address/{deposit_address}/update','DepositAddressController@update')->name('deposit.address.update');

        //Users
        Route::get('users', 'UserController@index')->name('users');
        Route::get('user/delete/{id}', 'UserController@destroy')->name('user.delete');
        Route::post('user/update/status', 'UserController@updateStatus')->name('user.update.status');
        

        Route::get('settings', 'SettingsController@index')->name('settings');
        Route::post('settings/update', 'SettingsController@update')->name('settings.update');
    });

    Route::get('test',function()
{
    $crypto = (array)json_decode('{"USD":{"name":"UnitedStatesDollar","img":"USD.svg","sname":"USD"},"KRW":{"name":"KoreanWon","img":"KRW.svg","sname":"KRW"},"INR":{"name":"IndianRupee","img":"inr.svg","sname":"INR"},"THB":{"name":"ThaiBaht","img":"thb.svg","sname":"THB"},"JPY":{"name":"JapaneseYen","img":"jp.svg","sname":"JPY"},"TRY":{"name":"TurkishLira","img":"tr.svg","sname":"TRY"} }'
     );

    print_r($crypto);die;
});

    Route::get('run/seed',function()
{
     \Artisan::call('db:seed');

    dd("seeding is cleared");
});

    Route::get('run/migration',function()
{
     \Artisan::call('migrate');

    dd("migrations is cleared");
});


});