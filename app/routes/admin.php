<?php

Route::prefix('admin')->name('admin.')->namespace('Admin')->middleware('guest')->group(function () {

    Route::get('/', 'Auth\LoginController@showLoginForm')->name('loginpage');
    Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
    Route::get('login', 'Auth\LoginController@logout')->name('logout');
    Route::post('login', 'Auth\LoginController@login')->name('login');
    Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
    Route::post('register', 'Auth\RegisterController@register')->name('register');

    // Route::group(function () {
        Route::get('dashboard', 'DashboardController@index')->name('dashboard');
        Route::get('deposit/requests','TransactionController@show')->name('deposit.requests.show');
        Route::get('wallet/deposit/{transaction}/change/status/{status}','TransactionController@changeStatus')->name('wallet.deposit.status');
        Route::get('users', 'UserController@index')->name('users');
    // });
});