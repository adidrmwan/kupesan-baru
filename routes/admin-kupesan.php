<?php  
Route::group(['middleware' => ['auth','role:superadmin']], function(){
	Route::get('/', 'AdminController@dashboard')->name('admin.dashboard');
    Route::get('/kupesan', 'SearchController@home')->name('admin.kupesan');
    Route::get('/approve/booking', 'AdminController@approveBooking')->name('approve.booking');
    Route::get('/cancel/booking', 'AdminController@cancelBooking')->name('cancel.booking');
    Route::get('/confirm/bukti', 'AdminController@confirmBukti')->name('confirm.bukti');
    Route::get('/cancel/bukti', 'AdminController@cancelBukti')->name('cancel.bukti');
    Route::get('/show/bukti', 'AdminController@showBukti')->name('show.bukti');
    Route::get('/partner-list', 'AdminController@partnerList')->name('daftar.partner');
    Route::get('/confirm/partner', 'AdminController@confirmPartner')->name('confirm.partner');
    Route::get('/show/partner', 'AdminController@showPartner')->name('show.partner');
    Route::get('/cancel/partner', 'AdminController@cancelPartner')->name('cancel.partner');

    // kebaya
    Route::get('/busana/approve/booking', 'AdminController@approveBookingKebaya')->name('kebaya.approve.booking');
    Route::get('/busana/cancel/booking', 'AdminController@cancelBookingKebaya')->name('kebaya.cancel.booking');
    Route::get('/busana/confirm/bukti', 'AdminController@confirmBuktiKebaya')->name('kebaya.confirm.bukti');
    Route::get('/busana/cancel/bukti', 'AdminController@cancelBuktiKebaya')->name('kebaya.cancel.bukti');
    Route::get('/busana/show/bukti', 'AdminController@showBuktiKebaya')->name('kebaya.show.bukti');
    Route::get('/busana/list/booking', 'AdminController@listBookingKebaya')->name('list.booking.kebaya');
    
    //spot foto
    Route::get('/spotfoto-free/all', 'AdminController@showAllFreeSpot')->name('show.free.spot');
    Route::get('/spotfoto-free/add', 'AdminController@addFreeSpot')->name('add.free-spot');
    Route::post('/spotfoto-free/store', 'AdminController@storeFreeSpot')->name('store.free-spot');
    Route::get('/spotfoto/delete', 'AdminController@cancelPartner')->name('cancel.free.spot');
    
    Route::get('/spot/all', 'AdminController@showAllPartnerSpot')->name('show.partner.spot');
    Route::get('/spot/add', 'AdminController@addPartnerSpot')->name('add.partner-spot');
    Route::post('/spot/store', 'AdminController@storePartnerSpot')->name('store.partner-spot');

    Route::namespace('Photographer')
    ->group(function () {
        Route::resource('pg-booking', 'AdminController');
        Route::get('/pg-booking/delete', 'AdminController@deletePackage')->name('pg-booking.delete');
        Route::group(['prefix' => 'admin-pg'], function(){
            Route::get('dashboard', 'AdminController@dashboard')->name('pg.dashboard');
            Route::get('approve/booking', 'AdminController@approveBooking')->name('pg.approve.booking');
            Route::get('cancel/booking', 'AdminController@cancelBooking')->name('pg.cancel.booking');
            Route::get('confirm/bukti', 'AdminController@confirmBukti')->name('pg.confirm.bukti');
            Route::get('cancel/bukti', 'AdminController@cancelBukti')->name('pg.cancel.bukti');
            Route::get('show/bukti', 'AdminController@showBukti')->name('pg.show.bukti');
        });

    });
});