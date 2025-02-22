<?php

use Illuminate\Support\Facades\Route;



Route::get('/', function () {
    return view('shaqshouse.index');
});

Route::get('/google/redirect', [LoginController::class, 'googleRedirect']);
Route::get('/facebook/redirect', [LoginController::class, 'facebookRedirect']);

Auth::routes();
Route::get('/', [App\Http\Controllers\MobileController::class, 'index'])->name('index.mobile');
Route::get('/home', [App\Http\Controllers\MobileController::class, 'index'])->name('home-index');
Route::group(['prefix'=>'mobile'], function(){
    Route::get('/get-started', [App\Http\Controllers\MobileController::class, 'index'])->name('index.mobile-get-started');
    Route::get('/search', [App\Http\Controllers\MobileController::class, 'search'])->name('search');
    Route::post('/search-post', [App\Http\Controllers\MobileController::class, 'search_post'])->name('search_post');
    Route::get('/veryfy-number', [App\Http\Controllers\MobileController::class, 'veryfy_number'])->name('veryfy-number');
    Route::get('/verification-code', [App\Http\Controllers\MobileController::class, 'verification_code'])->name('verification-code');

    Route::post('/update-profile', [App\Http\Controllers\MobileController::class, 'update_profile'])->name('update-profile');
    Route::post('/verify', [App\Http\Controllers\MobileController::class, 'verify'])->name('send-verify');
    Route::post('/send-verification', [App\Http\Controllers\MobileController::class, 'send_verification'])->name('send-verification');

    Route::get('/edit-profile-pic', [App\Http\Controllers\MobileController::class, 'edit_profile_pic'])->name('edit-profile-pic');
    Route::post('/edit-profile-pic', [App\Http\Controllers\MobileController::class, 'edit_profile_pic_post'])->name('edit-profile-pic-post');

    Route::get('/shopping-cart', [App\Http\Controllers\MobileController::class, 'shopping_cart'])->name('cart.list.mobile');
    Route::get('/shopping-cart/add-to-cart/{id}', [App\Http\Controllers\MobileController::class, 'add_to_cart'])->name('add-to-cart');
    Route::get('/shopping-cart/add-to-cart-get/{id}', [App\Http\Controllers\MobileController::class, 'add_to_cart_get'])->name('add-to-cart-get');
    Route::get('/shopping-cart/remove/{id}', [App\Http\Controllers\MobileController::class, 'removeCart'])->name('cart.remove.mobile');
    Route::get('/checkout', [App\Http\Controllers\MobileController::class, 'checkout'])->name('checkout');

    // APIs
    Route::get('/google', [LoginController::class, 'google']);
    Route::post('/stk-call-back', [App\Http\Controllers\MobileController::class, 'customerMpesaSTKPushCallBack'])->name('mobile/stk-call-back');
    Route::post('/stk-push', [App\Http\Controllers\MobileController::class, 'stk_push'])->name('stk-push');

    //Auths
    Route::post('/sign-up', [App\Http\Controllers\MobileLoginController::class, 'sign_up_post'])->name('mobile.signup.post');
    Route::get('/sign-in', [App\Http\Controllers\MobileLoginController::class, 'sign_in'])->name('sign-in');
    Route::get('/sign-up', [App\Http\Controllers\MobileLoginController::class, 'sign_up'])->name('mobile.sign-up');
    Route::get('/forgot-password', [App\Http\Controllers\MobileLoginController::class, 'forgot_password'])->name('mobile.forgot-password');
    Route::get('/email-success', [App\Http\Controllers\MobileLoginController::class, 'email_success'])->name('mobile.email-success');
    Route::get('/logout', [App\Http\Controllers\MobileLoginController::class, 'logouts']);

    Route::group(['prefix'=>'profile'], function(){
        Route::get('/', [App\Http\Controllers\MobileController::class, 'profile'])->name('profile');
        Route::get('/edit-profile', [App\Http\Controllers\MobileController::class, 'edit_profile'])->name('edit-profile');
        Route::post('/edit-profile-post', [App\Http\Controllers\MobileController::class, 'edit_profile_post'])->name('edit-profile-post');
        Route::get('/transactions', [App\Http\Controllers\MobileController::class, 'transactions'])->name('transactions');
        Route::get('/orders', [App\Http\Controllers\MobileController::class, 'orders'])->name('orders');
        Route::get('/orders/place-orders', [App\Http\Controllers\MobileController::class, 'place_orders'])->name('place-orders');
        Route::get('/orders/{id}', [App\Http\Controllers\MobileController::class, 'orders_details'])->name('orders-details');
        Route::get('/orders/re-order/{id}', [App\Http\Controllers\MobileController::class, 'orders_re_order'])->name('orders-re-order');
        Route::get('/orders/mailClient', [App\Http\Controllers\MobileController::class, 'mailClient'])->name('orders-mailClient');
    });
});
