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
        Route::get('/notice', 'Backend\SilkroadNoticeController@noticeIndex')->name('sro-notice-index-backend');
        Route::get('/notice/create', 'Backend\SilkroadNoticeController@noticeCreate')->name('sro-notice-create-backend');
        Route::post('/notice/save', 'Backend\SilkroadNoticeController@noticeSave')->name('sro-notice-save-backend');
        Route::get('/notice/{id}/edit', 'Backend\SilkroadNoticeController@noticeEdit')->name('sro-notice-edit-backend');
        Route::post('/notice/{id}/update', 'Backend\SilkroadNoticeController@noticeEditPatch')->name('sro-notice-patch-backend');
        Route::delete('/notice/{id}/destroy', 'Backend\SilkroadNoticeController@noticeDestroy')->name('sro-notice-edit-destroy');

        Route::get('/user', 'Backend\SilkroadController@indexSroUser')->name('sro-user-index-user-backend');
        Route::get('/user-datatables', 'Backend\SilkroadController@sroUserDatatables')->name('sro-user-datatables-backend');
        Route::get('/user/{user}/edit', 'Backend\SilkroadController@sroUserEdit')->name('sro-user-edit-backend');

        // Patching
        Route::post('/user/{user}/silk/add', 'Backend\SilkroadController@sroUserSilkAdd')->name('sro-user-silk-add-backend');
        Route::post('/user/{user}/block/add', 'Backend\SilkroadController@sroUserBlockAdd')->name('sro-user-block-add-backend');
        Route::post('/user/{user}/block/destory', 'Backend\SilkroadController@sroUserBlockDestory')->name('sro-user-block-destroy-backend');

        Route::get('/players', 'Backend\SilkroadController@indexSroPlayer')->name('sro-players-index-backend');
        Route::get('/players-datatables', 'Backend\SilkroadController@SroPlayerDatatables')->name('sro-players-datatables-backend');
        Route::get('/players/{char}/edit', 'Backend\SilkroadController@sroPlayerEdit')->name('sro-players-edit-backend');
    });

    Route::group(['prefix' => 'web'], function () {
        Route::group(['prefix' => 'downloads'], function () {
            Route::get('/', 'Backend\DownloadsController@index')->name('downloads-index-backend');
            Route::get('/add', 'Backend\DownloadsController@create')->name('downloads-create-backend');
            Route::get('/create', 'Backend\DownloadsController@show')->name('downloads-show-backend');
            Route::post('/create', 'Backend\DownloadsController@create')->name('downloads-create-backend');
            Route::get('/{download}/edit', 'Backend\DownloadsController@edit')->name('downloads-edit-backend');
            Route::patch('/{download}/update', 'Backend\DownloadsController@update')->name('downloads-update-backend');
            Route::post('/{download}/destroy', 'Backend\DownloadsController@destroy')->name('downloads-destroy-backend');
        });
        Route::group(['prefix' => 'images'], function () {
            Route::get('/', 'Backend\ImagesController@index')->name('images-index-backend');
            Route::get('/add', 'Backend\ImagesController@show')->name('images-show-backend');
            Route::post('/create', 'Backend\ImagesController@create')->name('images-create-backend');
            Route::post('/{image}/destroy', 'Backend\ImagesController@destroy')->name('images-destroy-backend');
        });

        Route::resource('/news', 'Backend\NewsController', [
            'as' => 'backend-news'
        ]);
    });

    // Logging
    Route::get('/smc-log', 'Backend\BackendController@smclogIndex')->name('smclog-index-backend');
    Route::get('/smc-log-datatables', 'Backend\BackendController@smclogDatatables')->name('smclog-datatables-backend');

    Route::get('/users-created-counts', 'Backend\UsersCreatedCounts@index')->name('users-created-counts-backend');

    Route::get('/users-blocked', 'Backend\BackendController@blockedAccountsIndex')->name('users-blocked-backend');
    Route::get('/users-blocked-datatables', 'Backend\BackendController@blockedAccountsDatatables')->name('users-blocked-datatables-backend');
});
