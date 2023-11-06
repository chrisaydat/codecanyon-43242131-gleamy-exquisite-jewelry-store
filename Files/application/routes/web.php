<?php

use App\Lib\Router;
use Illuminate\Support\Facades\Route;

Route::get('/clear', function(){
    \Illuminate\Support\Facades\Artisan::call('optimize:clear');
});

// User Support Ticket
Route::controller('TicketController')->prefix('ticket')->group(function () {
    Route::get('/', 'supportTicket')->name('ticket');
    Route::get('/new', 'openSupportTicket')->name('ticket.open');
    Route::post('/create', 'storeSupportTicket')->name('ticket.store');
    Route::get('/view/{ticket}', 'viewTicket')->name('ticket.view');
    Route::post('/reply/{ticket}', 'replyTicket')->name('ticket.reply');
    Route::post('/close/{ticket}', 'closeTicket')->name('ticket.close');
    Route::get('/download/{ticket}', 'ticketDownload')->name('ticket.download');
});

// Payment
Route::controller('Gateway\PaymentController')->group(function(){
    Route::any('donation', 'donation')->name('donation');
    Route::post('deposit/insert', 'depositInsert')->name('deposit.insert');
    Route::get('deposit/confirm', 'depositConfirm')->name('deposit.confirm');
    Route::get('deposit/manual', 'manualDepositConfirm')->name('deposit.manual.confirm');
    Route::post('deposit/manual', 'manualDepositUpdate')->name('deposit.manual.update');
});

Route::get('app/deposit/confirm/{hash}', 'Gateway\PaymentController@appDepositConfirm')->name('deposit.app.confirm');

Route::controller('SiteController')->group(function () {
    Route::get('/contact', 'contact')->name('contact');
    Route::post('/contact', 'contactSubmit');
    Route::get('/change/{lang?}', 'changeLanguage')->name('lang');

    Route::get('cookie-policy', 'cookiePolicy')->name('cookie.policy');

    Route::get('/cookie/accept', 'cookieAccept')->name('cookie.accept');

    Route::get('blog/{slug}/{id}', 'blogDetails')->name('blog.details');

    Route::get('policy/{slug}/{id}', 'policyPages')->name('policy.pages');

    Route::get('placeholder-image/{size}', 'placeholderImage')->name('placeholder.image');

    // blog
    Route::get('/blog','blog')->name('blog');
    // subscriber
    Route::post('/subscribe','subscribe')->name('subscribe');

    //  product search
    Route::post('/search','search')->name('search');

    // product
    Route::get('shop', 'shop')->name('shop');
    Route::get('/product/{slug}/{id}','productDetail')->name('product.detail');

    // custom Order
    Route::get('custom-order', 'getCustomOrder')->name('custom.order');
    Route::post('custom-order/store', 'storeCustomOrder')->name('custom.order.store');

    // category product
    Route::get('/products/category/{slug}/{id}','categoryProduct')->name('category.products');

    // cupon apply
    Route::post('/cupon','applyCupon')->name('apply.cupon');

    // cart
    Route::get('/cart','getCart')->name('get.cart');

    Route::post('add/to/cart/{id}', 'addCart')->name('add.to.cart');
    Route::get('update-cart', 'UpdateCart')->name('update.cart');
    Route::get('remove-from-cart', 'RemoveCart')->name('remove.from.cart');

    // checkout
    Route::get('/checkout','getChectout')->name('get.checkout');

    Route::get('/{slug}', 'pages')->name('pages');
    Route::get('/', 'index')->name('home');
});


