<?php

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::group(['prefix' => 'backend', 'middleware' => ['role:backend']], function () {
    Route::get('/', 'Backend\BackendController@index')->name('index-backend');

    // Silkroad
    Route::group(['prefix' => 'silkroad'], function () {
        Route::get('/user', 'Backend\SilkroadController@indexSroUser')->name('index-sro-user-backend');
        Route::get('/user-datatables', 'Backend\SilkroadController@sroUserDatatables')->name('sro-user-datatables-backend');
    });

    // Logging
    Route::get('/smc-log', 'Backend\BackendController@smclogIndex')->name('smclog-backend');
    Route::get('/smc-log-datatables', 'Backend\BackendController@smclogDatatables')->name('smclog-datatables-backend');
});
