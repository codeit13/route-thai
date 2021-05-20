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

        //Users
        Route::get('users', 'UserController@index')->name('users');
        Route::get('user/delete/{id}', 'UserController@destroy')->name('user.delete');
        Route::post('user/update/status', 'UserController@updateStatus')->name('user.update.status');
        

        Route::get('settings', 'SettingsController@index')->name('settings');
        Route::post('settings/update', 'SettingsController@update')->name('settings.update');
    });
});