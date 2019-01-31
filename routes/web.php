<?php
Auth::routes();
Route::get('/admin/login', 'AdminController@showLoginForm')->name('admin.login');

Route::get('/home', 'SearchController@home')->name('home');
Route::group(['prefix' => 'partner-ku'], function(){
    Route::get('', 'PartnerController@showPartnerKu')->name('jadi.mitra');
    Route::get('login', 'MitraAuth\RegisterController@showLoginForm')->name('mitra.login');
    Route::get('register', 'MitraAuth\RegisterController@showRegistrationForm')->name('mitra.daftar');
    Route::post('register', 'MitraAuth\RegisterController@register')->name('mitra.daftar.submit');
    Route::get('password/reset', 'MitraAuth\ForgotPasswordController@showLinkRequestForm')->name('mitra.password.request');
    Route::post('password/email', 'MitraAuth\ForgotPasswordController@sendResetLinkEmail')->name('mitra.password.email');
    Route::get('password/reset/{token}', 'MitraAuth\ResetPasswordController@showResetForm')->name('mitra.password.reset.token');
    Route::post('password/reset', 'MitraAuth\ResetPasswordController@reset')->name('mitra.password.reset');
});
Route::get('auth/{provider}', 'Auth\LoginController@redirectToProvider');
Route::get('auth/{provider}/callback', 'Auth\LoginController@handleProviderCallback');
Route::get('/', function () {
    if(Auth::check()) {    
        $user = Auth::user();
        $userrole = DB::table('role_user')
                    ->where('user_id', $user->id)
                    ->select('role_id')
                    ->first();
        if ( $userrole->role_id == '1' ) {
               return redirect()->route('admin.dashboard');
        } elseif ( $userrole->role_id == '2' ) {
               return redirect()->route('user.dashboard');
        } elseif ( $userrole->role_id == '3' ) {
               return redirect()->route('partner.dashboard');
        }  
    }
    return redirect()->intended(route('home'));      
})->name('index');

//Detail Partner (Button View More)
Route::get('detail/partner/spotfoto', 'StudioController@detailFotostudio')->name('detail.fotostudio');
Route::get('detail/partner/busana', 'StudioController@detailKebaya')->name('detail.kebaya');
Route::get('detail/partner/freespot', 'StudioController@detailFreeSpot')->name('detail.freespot');


Route::get('detail/partner/spotfoto/paket', 'StudioController@detailPaketSpot')->name('detail.paket.spot');

//Search at Home by tag & kota
Route::post('/search/spotfoto', 'SearchController@searchFotostudio')->name('search.fotostudio');
Route::post('/search/busana', 'SearchController@searchKebaya')->name('search.kebaya');
Route::post('/search/fotografer', 'SearchController@searchFotografer')->name('search.fotografer');

//Search at navigation box
Route::post('/search', 'SearchController@searchData')->name('search.data');

// ADMIN ROUTE
Route::prefix('admin-kupesan')->group(base_path('routes/admin-kupesan.php'));
// PARTNER ROUTE
Route::prefix('partner')->group(base_path('routes/partner.php'));

// Route untuk email verification
Route::get('/user/activation/{token}', 'Auth\RegisterController@userActivation');
Route::get('/partner/activation/2/{token}', 'MitraAuth\RegisterController@userActivation');
Route::get('/partner/activation/{token}', 'AdminController@partnerActivation');
Route::get('/partner/dashboard/{token}', 'PartnerController@bookingActivation');
Route::get('/partner/dashboard/busana/{token}', 'PartnerController@bookingActivationBusana');
Route::get('/booking/approved/{token}', 'AdminController@bookingActivation');
Route::get('/booking/approved/busana/{token}', 'AdminController@bookingActivationKebaya');


// Route untuk user yang member
Route::group(['prefix' => '2', 'middleware' => ['auth','role:user']], function(){
    Route::get('/', function(){
        return redirect()->intended(route('home'));
    })->name('user.dashboard');
    Route::get('/booking/ps/2', 'BookingController@step2')->name('check.auth');
    Route::post('/booking/ps/3', 'BookingController@step3')->name('form.pesan2');
    Route::post('/booking/ps/4', 'BookingController@step4')->name('form.pesan');
    Route::post('/booking/ps/5', 'BookingController@step5')->name('form.step5');
    Route::get('/booking/ps/6', 'BookingController@step6')->name('form.step6');
    Route::post('/booking/ps/7', 'BookingController@step7')->name('form.step7');
    Route::post('/booking/ps/8', 'BookingController@showKonfirmasi')->name('form.konfirmasi');   
    Route::post('/booking/ps/9', 'BookingController@uploadBukti')->name('upload.bukti');
    Route::get('/booking/ps/9', 'BookingController@voucher')->name('voucher');
    
    Route::post('/booking/7', 'BookingController@showReview')->name('form.booking');
    Route::get('/profil-KU', 'CustomerController@dashboard')->name('dashboard');
    Route::post('/booking/info/', 'CustomerController@showInfo')->name('booking.info');

    // busana 
    Route::get('/booking/busana/2', 'KebayaBookingController@step2')->name('kebaya.step2');
    Route::post('/booking/busana/2', 'KebayaBookingController@submitStep2')->name('kebaya.submit.step2');
    Route::get('/booking/busana/2a', 'KebayaBookingController@step2a')->name('kebaya.step2a');
    Route::post('/booking/busana/2a', 'KebayaBookingController@submitStep2a')->name('kebaya.submit.step2a');
    Route::get('/booking/busana/3', 'KebayaBookingController@step3')->name('kebaya.step3');
    Route::post('/booking/busana/3', 'KebayaBookingController@submitStep3')->name('kebaya.submit.step3');
    Route::get('/booking/busana/4', 'KebayaBookingController@step4')->name('kebaya.step4');
    Route::post('/booking/busana/4', 'KebayaBookingController@submitStep4')->name('kebaya.submit.step4');
    Route::get('/booking/busana/6', 'KebayaBookingController@step6')->name('kebaya.step6');
    Route::post('/booking/busana/7', 'KebayaBookingController@step7')->name('kebaya.step7');
    Route::post('/booking/busana/8', 'KebayaBookingController@step8')->name('kebaya.step8');
    Route::post('/booking/busana/9', 'KebayaBookingController@uploadBukti')->name('kebaya.upload.bukti');
    Route::get('/booking/busana/9', 'KebayaBookingController@step9')->name('kebaya.step9');
    Route::post('/booking/busana/info', 'CustomerController@showKebayaInfo')->name('kebaya.booking.info');

    // Photographer 
    Route::namespace('Photographer')
    ->group(function () {
        Route::group(['prefix' => 'booking/pg'], function(){
            Route::get('2', 'BookingController@step2')->name('pg.step2');
            Route::post('2', 'BookingController@submitStep2')->name('pg.submit.step2');
        });

    });
});
Route::get('/booking/busana/1', 'KebayaBookingController@step1')->name('kebaya.step1');
Route::get('/booking/ps/1', 'BookingController@step1')->name('ask.page');
Route::get('/booking/pg/1', 'Photographer\BookingController@step1')->name('pg.step1');

//Route untuk studio foto
Route::get('/studio/detail', 'StudioController@studiodetail')->name('studio-detail');
Route::get('/studiolist', 'StudioController@studiolist')->name('studio-list');

// Route Jadi Mitra

//Clear Cache facade value:
Route::get('/clear-cache', function() {
    $exitCode = Artisan::call('cache:clear');
    return '<h1>Cache facade value cleared</h1>';
});

//Reoptimized class loader:
Route::get('/optimize', function() {
    $exitCode = Artisan::call('optimize');
    return '<h1>Reoptimized class loader</h1>';
});

//Route cache:
Route::get('/route-cache', function() {
    $exitCode = Artisan::call('route:cache');
    return '<h1>Routes cached</h1>';
});

//Clear Route cache:

Route::get('/route-clear', function() {
    $exitCode = Artisan::call('route:clear');
    return '<h1>Route cache cleared</h1>';
});

//Clear View cache:
Route::get('/view-clear', function() {
    $exitCode = Artisan::call('view:clear');
    return '<h1>View cache cleared</h1>';
});

//Clear Config cache:
Route::get('/config-cache', function() {
    $exitCode = Artisan::call('config:cache');
    return '<h1>Clear Config cleared</h1>';
});

Route::get('/pageerror', 'PageController@pageerror')->name('page-error');

Route::get('/tnc', 'CustomerController@tnc')->name('term');
Route::get('/privacy', 'CustomerController@privacy')->name('privacy');

Route::get('/json-regencies','CountryController@regencies');
Route::get('/json-districts', 'CountryController@districts');
Route::get('/json-village', 'CountryController@villages');

Route::get('/json-regencies4','CountryController@regencies4');
Route::get('/json-districts4', 'CountryController@districts4');
Route::get('/json-village4', 'CountryController@villages4');

Route::get('/json-regencies1','BookingController@regencies');
Route::get('/json-districts1', 'BookingController@districts');
Route::get('/json-village1', 'BookingController@villages');
Route::get('/json-village2', 'BookingController@villages2');

Route::get('/json-regencies3', 'KebayaBookingController@regencies3');



