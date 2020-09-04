<?php

Auth::routes();


Route::get('/', 'Frontend\IndexController@index')->name('index');

// Signature
Route::get('/signature/{ref?}', 'Frontend\IndexController@signatureRef')->name('signature-index');

// News
Route::get('/news/{slug}', 'Frontend\NewsController@index')->name('news-slug');
Route::get('/news-archive', 'Frontend\NewsController@archive')->name('news-archive');

// Other
Route::get('/downloads', 'Frontend\IndexController@downloads')->name('downloads-index');
Route::get('/rules', 'Frontend\IndexController@rules')->name('rules-index');

// Ranking
Route::group(['prefix' => 'ranking'], static function () {
    Route::get('/{mode?}', 'Frontend\RankingController@index')->name('ranking-index');
});

// Server Information
Route::get('/server-information', 'Frontend\IndexController@serverInformation')->name('server-information');

// Needed to be logged in after that
Auth::routes(['verify' => true]);

// User Dashboard
Route::group(['prefix' => 'account'], static function() {
    Route::get('/', 'Frontend\AccountController@index')->name('home');
    Route::get('/chars', 'Frontend\AccountController@charList')->name('home-chars-list');
    Route::get('/settings', 'Frontend\AccountController@settings')->name('home-settings');
    Route::post('/settings/update', 'Frontend\AccountController@settingsUpdate')->name('home-settings-update');
    Route::get('/referral', 'Frontend\AccountController@referral')->name('home-referral');
    Route::get('/referral-datatables', 'Frontend\AccountController@referralDatatables')->name('home-referral-datatables');
    Route::get('/voucher', 'Frontend\AccountController@voucher')->name('home-voucher');
    Route::get('/voucher-datatables', 'Frontend\AccountController@voucherDatatables')->name('home-voucher-datatables');
    Route::post('/voucher/use', 'Frontend\AccountController@voucherUse')->name('home-voucher-use');
    Route::get('/notification', 'Frontend\NotificationController@index')->name('notification');
    Route::get('/notification/{id}', 'Frontend\NotificationController@markAsRead')->name('notification-mark-as-read')->where('id', '[0-9]+');
    Route::get('/notification/mark-all', 'Frontend\NotificationController@markAllAsRead')->name('notification-mark-all');
    Route::group(['prefix' => 'tickets'], static function() {
        Route::get('/', 'Frontend\TicketController@tickets')->name('home-tickets');
        Route::get('/new', 'Frontend\TicketController@ticketsNew')->name('home-tickets-new');
        Route::post('/new', 'Frontend\TicketController@ticketsNewSubmit')->name('home-tickets-new-submit');
        Route::get('/datatables', 'Frontend\TicketController@ticketsDatatables')->name('home-tickets-datatables');
        Route::get('/show/{id}', 'Frontend\TicketController@ticketShow')->name('home-tickets-show');
        Route::post('/show/{id}/reply', 'Frontend\TicketController@ticketShowSubmit')->name('home-tickets-show-submit');
    });

    Route::group(['prefix' => 'web-inventory'], static function () {
       Route::get('/', 'Frontend\WebInventoryController@index')->name('web-inventory-index');
       Route::get('/select-character', 'Frontend\WebInventoryController@selectCharacter')->name('web-i-select-character');
       Route::post('/update-gold', 'Frontend\WebInventoryController@updateGold')->name('web-i-update-gold');
       Route::post('/transfer-item-to-web', 'Frontend\WebInventoryController@transferItemToWeb')->name('web-i-transfer-item-to-web');
       Route::post('/transfer-item-to-game', 'Frontend\WebInventoryController@transferItemToGame')->name('web-i-transfer-item-to-game');
       Route::get('/inventory', 'Frontend\WebInventoryController@inventory')->name('web-i-inventory');
    });
});

// Character and Guild Information
Route::get('/player/{CharName16}', 'Frontend\InformationController@player')->name('information-player');
Route::get('/guild/{name}', 'Frontend\InformationController@guild')->name('information-guild');

// Auctions House
Auth::routes(['verify' => true]);
Route::group(['prefix' => 'auctions-house'], static function () {
    Route::get('/', 'Frontend\AuctionsHouseController@index')->name('auctions-house');
    Route::get('/filter/{type?}', 'Frontend\AuctionsHouseController@filterType')->name('auction-house-filter');
    Route::get('/show/{id}', 'Frontend\AuctionsHouseController@showItem')->name('auctions-house-show-item');
    Route::get('/own', 'Frontend\AuctionsHouseController@showOwn')->name('auction-house-show-own');
    Route::post('/own/{id}/cancel', 'Frontend\AuctionsHouseController@cancelOwn')->name('auction-house-cancel-own');
    Route::get('/add', 'Frontend\AuctionsHouseController@showAddItem')->name('auctions-house-add-item');
    Route::post('/add-auction', 'Frontend\AuctionsHouseController@submitAddItem')->name('auctions-house-submit-add-item');

    Route::post('/show/{id}/bid', 'Frontend\AuctionsHouseController@submitBidItem')->name('auctions-house-bid-item');
    Route::post('/show/{id}/buy', 'Frontend\AuctionsHouseController@submitBuyItemNow')->name('auctions-house-buy-item-now');
});

// Backend Routes
Route::group(['prefix' => 'backend', 'middleware' => ['role:administrator']], static function () {
    Route::get('/', 'Backend\BackendController@index')->name('index-backend');

    // SoX count filter
    Route::get('/soxcount/{filter?}', 'Backend\BackendController@soxCountFilter')->name('sox-count-filter-backend');
    Route::get('/show/sox/{filter?}', 'Backend\BackendController@showSoxCount')->name('sox-count-filter-show-backend');

    // SilkroadTodo
    Route::post('/todo/add', 'Backend\BackendController@todoAdd')->name('todo-add-backend');
    Route::post('/todo/{id}/delete', 'Backend\BackendController@todoDelete')->name('todo-delete-backend');

    // Server Information
    Route::group(['prefix' => 'server-information'], static function() {
        Route::get('/', 'Backend\ServerInformationController@index')->name('server-information-index-backend');
        Route::get('/create', 'Backend\ServerInformationController@showAdd')->name('server-information-show-add-backend');
        Route::post('/add', 'Backend\ServerInformationController@add')->name('server-information-add-backend');
        Route::get('/edit/{id}', 'Backend\ServerInformationController@showEdit')->name('server-information-edit-show-backend');
        Route::post('/update/{id}', 'Backend\ServerInformationController@update')->name('server-information-update-backend');
        Route::delete('/destroy/{id}', 'Backend\ServerInformationController@destroy')->name('server-information-destroy-backend');
    });

    // Ticket
    Route::group(['prefix' => 'ticket'], static function () {
        Route::get('/{conversation?}', 'Backend\TicketController@list')->name('ticket-index-list')->where(['conversation' => '[0-9]+']);
        Route::get('/fetch', 'Backend\TicketController@fetch')->name('ticket-fetch-backend');
        Route::post('/send', 'Backend\TicketController@send')->name('ticket-send-backend');
        Route::get('/conversations', 'Backend\TicketController@fetchConversations')->name('ticket-conversations-backend');
        Route::get('/settings', 'Backend\TicketController@settings')->name('ticket-settings-backend');
        Route::post('/close', 'Backend\TicketController@close')->name('ticket-close-backend');
        Route::group(['prefix' => 'category'], static function () {
            Route::match(['get', 'post'], '/create', 'Backend\TicketController@categoryCreate')->name('ticket-category-create');
            Route::match(['get', 'post'], '/{id}', 'Backend\TicketController@categoryUpdate')->name('ticket-category-update');
            Route::post('/delete/{id}', 'Backend\TicketController@categoryDelete')->name('ticket-category-delete');
        });
        Route::group(['prefix' => 'priority'], static function () {
            Route::match(['get', 'post'], '/create', 'Backend\TicketController@priorityCreate')->name('ticket-priority-create');
            Route::match(['get', 'post'], '/{id}', 'Backend\TicketController@priorityUpdate')->name('ticket-priority-update');
            Route::post('/delete/{id}', 'Backend\TicketController@priorityDelete')->name('ticket-priority-delete');
        });
    });

    // Silkroad
    Route::group(['prefix' => 'silkroad'], static function () {
        Route::group(['prefix' => 'notice'], static function () {
            Route::get('/', 'Backend\SilkroadNoticeController@noticeIndex')->name('sro-notice-index-backend');
            Route::get('/create', 'Backend\SilkroadNoticeController@noticeCreate')->name('sro-notice-create-backend');
            Route::post('/save', 'Backend\SilkroadNoticeController@noticeSave')->name('sro-notice-save-backend');
            Route::get('/{id}/edit', 'Backend\SilkroadNoticeController@noticeEdit')->name('sro-notice-edit-backend');
            Route::post('/{id}/update', 'Backend\SilkroadNoticeController@noticeEditPatch')->name('sro-notice-patch-backend');
            Route::delete('/{id}/destroy', 'Backend\SilkroadNoticeController@noticeDestroy')->name('sro-notice-edit-destroy');
        });

        Route::get('/user', 'Backend\SilkroadController@indexSroUser')->name('sro-user-index-user-backend');
        Route::get('/user-datatables', 'Backend\SilkroadController@sroUserDatatables')->name('sro-user-datatables-backend');
        Route::get('/user/{user}/edit', 'Backend\SilkroadController@sroUserEdit')->name('sro-user-edit-backend');
        Route::match(['put', 'patch'], '/user/{user}/role', 'Backend\SilkroadController@syncRoles')->name('sro-user-role-sync-backend');

        Route::get('/players', 'Backend\SilkroadController@indexSroPlayer')->name('sro-players-index-backend');
        Route::get('/players-datatables', 'Backend\SilkroadController@SroPlayerDatatables')->name('sro-players-datatables-backend');
        Route::get('/players/{char}/edit', 'Backend\SilkroadController@sroPlayerEdit')->name('sro-players-edit-backend');

        Route::get('/guilds', 'Backend\SilkroadGuildController@indexSroGuild')->name('sro-guild-index-backend');
        Route::get('/guilds-datatables', 'Backend\SilkroadGuildController@sroGuildDatatables')->name('sro-guild-datatables-backend');
        Route::get('/guilds/{guild}/edit', 'Backend\SilkroadGuildController@sroGuildEdit')->name('sro-guild-edit-backend');
        Route::get('/guilds/{guild}/edit-datatables', 'Backend\SilkroadGuildController@sroGuildEditDatatables')->name('sro-guild-edit-datatables-backend');

        // Patching TB_User
        Route::post('/user/{user}/silk/add', 'Backend\SilkroadController@sroUserSilkAddRemove')->name('sro-user-silk-backend');
        Route::post('/user/{user}/block/add', 'Backend\SilkroadController@sroUserBlockAdd')->name('sro-user-block-add-backend');
        Route::post('/user/{user}/block/destory', 'Backend\SilkroadController@sroUserBlockDestory')->name('sro-user-block-destroy-backend');

        // Patching _Char
        Route::post('/players/{char}/unstuck', 'Backend\SilkroadController@sroUnstuckChar')->name('sro-players-unstuck');

        // Hide Ranking
        Route::get('/hideranking', 'Backend\HideRankingController@index')->name('hide-ranking-index-backend');
        Route::post('/hideranking/add', 'Backend\HideRankingController@add')->name('hide-ranking-add-backend');
        Route::post('/hideranking/{id}/destroy', 'Backend\HideRankingController@destroy')->name('hide-ranking-destroy-backend');
    });

    // Web
    Route::group(['prefix' => 'web'], static function () {
        Route::get('/settings', 'Backend\SiteSettingsController@index')->name('site-settings-backend');
        Route::post('/settings/update', 'Backend\SiteSettingsController@update')->name('site-settings-update-backend');

        Route::get('/auctionshouse', 'Backend\AuctionsHouseController@index')->name('auctionshouse-settings-backend');
        Route::post('/auctionshouse/update', 'Backend\AuctionsHouseController@update')->name('auctionshouse-settings-update-backend');
        Route::get('/auctionshouse/log','Backend\AuctionsHouseController@showLog')->name('auctionshouse-log-backend');
        Route::get('/auctionshouse/log/datatables', 'Backend\AuctionsHouseController@showLogDatatables')->name('auctionshouse-log-datatables-backend');

        Route::group(['prefix' => 'downloads'], static function () {
            Route::get('/', 'Backend\DownloadsController@index')->name('downloads-index-backend');
            Route::get('/add', 'Backend\DownloadsController@show')->name('downloads-add-backend');
            Route::post('/create', 'Backend\DownloadsController@create')->name('downloads-create-backend');
            Route::get('/{download}/edit', 'Backend\DownloadsController@edit')->name('downloads-edit-backend');
            Route::patch('/{download}/update', 'Backend\DownloadsController@update')->name('downloads-update-backend');
            Route::post('/{download}/destroy', 'Backend\DownloadsController@destroy')->name('downloads-destroy-backend');
        });
        Route::group(['prefix' => 'images'], static function () {
            Route::get('/', 'Backend\ImagesController@index')->name('images-index-backend');
            Route::get('/add', 'Backend\ImagesController@show')->name('images-show-backend');
            Route::post('/create', 'Backend\ImagesController@create')->name('images-create-backend');
            Route::post('/{image}/destroy', 'Backend\ImagesController@destroy')->name('images-destroy-backend');
        });

        Route::resource('/news', 'Backend\NewsController', [
            'as' => 'backend-news'
        ]);

        Route::group(['prefix' => 'voucher'], static function () {
            Route::get('/', 'Backend\VoucherController@index')->name('voucher-index-backend');
            Route::get('/datatables', 'Backend\VoucherController@indexDatatables')->name('voucher-index-datatables-backend');
            Route::get('/add', 'Backend\VoucherController@addForm')->name('voucher-add-backend');
            Route::post('/create', 'Backend\VoucherController@create')->name('voucher-create-backend');
            Route::post('/{id}/destroy', 'Backend\VoucherController@destroy')->name('voucher-destroy-backend');
        });

        Route::group(['prefix' => 'backlinks'], static function() {
            Route::get('/', 'Backend\BacklinksController@index')->name('backlinks-index-backend');
            Route::get('/add', 'Backend\BacklinksController@show')->name('backlinks-add-backend');
            Route::post('/create', 'Backend\BacklinksController@create')->name('backlinks-create-backend');
            Route::get('/{backlink}/edit', 'Backend\BacklinksController@edit')->name('backlinks-edit-backend');
            Route::patch('/{backlink}/update', 'Backend\BacklinksController@update')->name('backlinks-update-backend');
            Route::post('/{backlink}/destroy', 'Backend\BacklinksController@destroy')->name('backlinks-destroy-backend');
        });

        Route::group(['prefix' => 'supporters-online'], static function () {
            Route::get('/', 'Backend\SupportersOnlineController@index')->name('supporters-online-index-backend');
            Route::post('/add', 'Backend\SupportersOnlineController@add')->name('supporters-online-add-backend');
            Route::post('/{id}/destroy', 'Backend\SupportersOnlineController@destroy')->name('supporters-online-destroy-backend');
        });
    });

    // Logging
    Route::get('/smc-log', 'Backend\BackendController@smclogIndex')->name('smclog-index-backend');
    Route::get('/smc-log-datatables', 'Backend\BackendController@smclogDatatables')->name('smclog-datatables-backend');

    Route::get('/users-created-counts', 'Backend\UsersCreatedCounts@index')->name('users-created-counts-backend');

    Route::get('/users-blocked', 'Backend\BackendController@blockedAccountsIndex')->name('users-blocked-backend');
    Route::get('/users-blocked-datatables', 'Backend\BackendController@blockedAccountsDatatables')->name('users-blocked-datatables-backend');

    Route::get('/worldmap', 'Backend\BackendController@worldmapIndex')->name('worldmap-index-backend');
});
