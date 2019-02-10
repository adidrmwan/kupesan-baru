<?php  
Route::group(['middleware' => ['auth','role:partner']], function(){
    //All Partner
    Route::get('/', 'PartnerController@dashboard')->name('partner.dashboard');
    Route::get('/welcome', 'PartnerController@showDetailMitra')->name('partner.profile.form');
    Route::post('/welcome', 'PartnerController@submitDetailMitra')->name('partner.profile.form.submit');
    Route::get('/facilities', 'PartnerController@showFormFacilities')->name('partner.facilities.form');
    Route::post('/facilities', 'PartnerController@submitFormFacilities')->name('partner.facilities.form.submit');
    Route::get('/form/dayoff', 'PartnerController@showFormDayOff')->name('form.dayoff');
    Route::post('/form/dayoff', 'PartnerController@submitFormDayOff')->name('form.dayoff.submit');

    Route::namespace('Photographer')
    ->group(function () {
        Route::resource('pg-package', 'PackageController');
        Route::get('/pg-package/delete', 'PackageController@deletePackage')->name('delete.pg.package');
        Route::group(['prefix' => 'pg'], function(){
            Route::get('dashboard', 'PartnerController@dashboard')->name('pg.dashboard');
            Route::get('profile', 'PartnerController@profile')->name('pg.profile');
            Route::post('profile', 'PartnerController@updateProfile')->name('pg.profile.update');
            Route::get('approve/booking', 'AdminController@approveBooking')->name('pg.partner.approve.booking');
            Route::get('cancel/booking', 'PartnerController@cancelBooking')->name('pg.partner.cancel.booking');
        });

    });

    Route::namespace('Mua')
    ->group(function () {
        Route::resource('mua-package', 'MuaPackageController');
        Route::group(['prefix' => 'mua'], function(){
            Route::get('profile', 'MuaPartnerController@profile')->name('mua.profile');
            Route::post('profile', 'MuaPartnerController@updateProfile')->name('mua.profile.update');
            Route::get('schedule', 'MuaPartnerController@showBookingSchedule')->name('mua.schedule');
            Route::get('/booking/offline/3/1', 'MuaBookingController@showStep1')->name('mua.off-booking');
            Route::get('/form/dayoff/3', 'MuaPartnerController@showFormDayOff')->name('mua.form.dayoff');
            Route::post('/form/dayoff/3', 'MuaPartnerController@submitFormDayOff')->name('mua.form.dayoff.submit');
            Route::get('/booking/history/3', 'MuaPartnerController@showBookingHistory')->name('mua.history');

        });
    });
    // fotostudio
    Route::get('/booking/ps/schedule', 'PartnerController@showBookingSchedule')->name('booking.schedule');
    Route::get('/booking/ps/history', 'PartnerController@showBookingHistory')->name('booking.history');
    Route::get('/booking/offline/1', 'PartnerController@showStep1')->name('form.offline');
    Route::get('/booking/offline/1/2', 'PartnerController@showStep2')->name('form.offline.step2');
    Route::post('/booking/offline/1/2', 'PartnerController@submitStep2')->name('form.offline.step2.submit');
    Route::post('/booking/offline/1/3', 'PartnerController@submitStep3')->name('form.offline.step3.submit');
    Route::post('/booking/offline/1/4', 'PartnerController@submitStep4')->name('form.offline.step4.submit');
    Route::post('/booking/offline', 'PartnerController@submitFormOffline')->name('form.offline.submit');

    Route::get('/profile', 'PartnerController@profile')->name('partner.profile');
    Route::post('/profile', 'PartnerController@submitEditProfile')->name('partner.profile.form.edit');
    
    // PORTOFOLIO
    Route::get('portofolio', 'PortofolioController@showPortofolio')->name('partner.portofolio');
    Route::post('portofolio', 'PortofolioController@uploadPortofolio')->name('partner.upload.portofolio');
    Route::post('portofolio/update', 'PortofolioController@updatePortofolio')->name('partner.update.portofolio');
    // END OF PORTOFOLIO

    Route::get('/booking/detail', 'PartnerController@showDetailBooking')->name('detail.booking');
    Route::post('/booking/completed', 'BookingController@orderCompleted')->name('order.completed');

    Route::post('/profile/fasilitas', 'AlbumController@updateFasilitas')->name('update.fasilitas');
    Route::post('/profile/tnc', 'PartnerController@updateTNC')->name('update.tnc');
    Route::get('/profile/tnc/delete', 'PartnerController@deleteTNC')->name('delete.tnc');
    Route::post('/profile/upload/logo', 'PartnerController@uploadLogo')->name('partner.upload.logo');
    Route::get('/booking/ps/finished', 'PartnerController@bookingFinished')->name('booking.finished');
    Route::get('/booking/ps/cancel', 'PartnerController@bookingCancel')->name('booking.cancel');
    Route::get('/approve/booking', 'AdminController@approveBooking')->name('sp.approve.booking');
    Route::get('/cancel/booking', 'AdminController@cancelBooking')->name('sp.cancel.booking');

    // fotostudio paket
    Route::get('/ps/package/add', 'PackageController@showAddPackage')->name('partner.addpackage');
    Route::post('/ps/package/add', 'PackageController@addPackage')->name('partner.addpackage.submit');
    Route::get('/ps/package/list', 'PackageController@listPackage')->name('partner.listpackage');
    Route::post('/ps/package/edit', 'PackageController@showEditPackage')->name('partner.editpackage');
    Route::post('/ps/package/update', 'PackageController@editPackage')->name('partner.editpackage.submit');
    Route::post('/ps/package/delete', 'PackageController@deletePackage')->name('partner.deletepackage');
    Route::get('/ps/package/update/{$id}', 'PartnerController@UpdatePackagePartner')->name('partner-updatepackage-button');
    Route::get('/ps/package/duration/delete', 'PackageController@deleteDurasi')->name('durasi.delete');

    // Kebaya
    Route::resource('kebaya-package', 'KebayaPackageController');
    Route::get('kebaya-package/biaya/delete', 'KebayaPackageController@deleteBiayaSewa')->name('kebaya.delete.biaya');
    Route::get('/kebaya-package/action/non-active', 'KebayaPackageController@setNonActive')->name('set.nonactive');
    Route::get('/kebaya-package/action/active', 'KebayaPackageController@setActive')->name('set.active');

    Route::get('/profile/4', 'KebayaController@profile')->name('kebaya.profile');
    Route::post('/profile/4', 'KebayaController@submitEditProfile')->name('kebaya.profile.submit');
    Route::post('/profile/tnc/4', 'KebayaController@updateTNC')->name('kebaya.tnc.submit');
    Route::get('/profile/tnc/delete/4', 'KebayaController@deleteTNC')->name('kebaya.delete.tnc');
    Route::get('/booking/offline/4/1', 'KebayaController@showStep1')->name('kebaya.off-booking');
    Route::get('/booking/offline/4/2', 'KebayaController@showStep2')->name('kebaya.off-booking.step2');
    Route::post('/booking/offline/4/2', 'KebayaController@submitStep2')->name('kebaya.off-booking.step2.submit');
    Route::get('/booking/offline/4/3', 'KebayaController@showStep3')->name('kebaya.off-booking.step3');
    Route::post('/booking/offline/4/3', 'KebayaController@submitStep3')->name('kebaya.off-booking.step3.submit');
    Route::post('/booking/offline/4/4', 'KebayaController@submitStep4')->name('kebaya.off-booking.step4.submit');
    Route::get('/booking/schedule/4', 'KebayaController@showBookingSchedule')->name('kebaya.schedule');
    Route::get('/booking/history/4', 'KebayaController@showBookingHistory')->name('kebaya.history');
    Route::get('/booking/cancel', 'KebayaController@bookingCancel')->name('kebaya.booking.cancel');
    Route::get('/booking/finished', 'KebayaController@bookingFinished')->name('kebaya.booking.finished');
    Route::get('/booking/finished/online', 'KebayaController@bookingFinishedOnline')->name('kebaya.booking.finished.online');
    Route::post('/profile/panduan-ukuran/update', 'KebayaController@updatePU')->name('kebaya.update.pu');
    Route::get('/profile/panduan-ukuran/delete', 'KebayaController@deletePU')->name('kebaya.delete.pu');
    Route::get('/booking/detail/4', 'KebayaController@showDetailBooking')->name('detail.booking.kebaya');
    Route::get('/approve/booking/4', 'AdminController@approveBookingKebaya')->name('partner.approve.booking');
    Route::get('/cancel/booking/4', 'AdminController@cancelBookingKebaya')->name('partner.cancel.booking');
    
    
    Route::get('/form/dayoff/4', 'KebayaController@showFormDayOff')->name('kebaya.form.dayoff');
    Route::post('/form/dayoff/4', 'KebayaController@submitFormDayOff')->name('kebaya.form.dayoff.submit');
});