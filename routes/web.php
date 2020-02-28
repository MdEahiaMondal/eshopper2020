<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::match(['get', 'post'], '/admin', 'Backend\AdminController@login')->name('admin.login');


Route::group([ 'as' => 'admin.',  'namespace' => 'Backend', 'prefix' => 'admin', 'middleware' => 'admin'], function (){

    // user section controller
    Route::resource('user', 'UserController');
    Route::get('users/chart-show', 'UserController@UserListChart')->name('user.chart.list');
    Route::get('users/country-wise', 'UserController@countryWiseUserToCharts')->name('user.country.wise.chart.list');


    // admin section controller
    Route::resource('role_permission', 'RolePermission');
    Route::get('dashboard', 'AdminController@index')->name('home');
    Route::get('logout', 'AdminController@logout')->name('logout');
    Route::get('setting', 'AdminController@setting')->name('setting');
    Route::get('setting/check/password', 'AdminController@checkPassword')->name('check.password');
    Route::match( ['get', 'post'],'setting/check/password/update', 'AdminController@passwordUpdate')->name('password.update');

    // Category section controller
    Route::resource('category', 'CategoryController');
    Route::resource('product', 'ProductController');
    Route::get('add/product/{id}/attribute', 'ProductController@addProductAttribute')->name('add.product.attribute');
    Route::post('add/product/{id}/attribute', 'ProductController@addProductAttributeStore')->name('product.attribute.store');
    Route::post('update/product/{id}/attribute', 'ProductController@updateProductAttributeStore')->name('add.product.attribute.update');
    Route::post('product/{id}/images', 'ProductController@addProductImageStore')->name('product.images.store');
    Route::get('product/{id}/image', 'ProductController@ShowProductImageForm')->name('product.images.form');
    Route::get('product/excel/file', 'ProductController@poductExcelFileDowenload')->name('get.products.excel');

    // apply coupons
    Route::resource('coupon','CouponController');
    // get excel file for dowenload
    Route::get('coupon-list/excel-file','CouponController@CouponListExcel')->name('get.coupon.dowenload.excel');



    // Banner Controller
    Route::resource('banner','BannerController');

    // order
    Route::resource('order','OrderController');
    Route::post('order/status','OrderController@orderStatusUpdate')->name('order.status.update');
    Route::get('order/{order}/invoice','OrderController@orderInvoice')->name('order.invoice');
    Route::get('order/{order}/pdf/invoice','OrderController@orderPdfInvoice')->name('order.pdf.invoice');
    Route::get('orders/chart-show', 'OrderController@orderChartList')->name('order.chart.list');

    // cms pages
    Route::resource('cms_page','CmsPageController');
    Route::resource('currencie','CurrencieController');

    // shipping charge
    Route::resource('shipping_charge','ShippingChargeController');

    // shipping charge
    Route::resource('newsleter_subscriber','NewsleterSubscriber');
    // get excel file for dowenload
    Route::get('newsleter-subscriber/excel-file','NewsleterSubscriber@subscriberExcelFile')->name('get.newsleter.subscriber.excel');

});












/********************************frontend controller************************/
Route::get('/', 'Frontend\HomeController@index');
Route::get('/products/{url}', 'Frontend\HomeController@products')->name('products');
Route::get('/product/detail/{url}', 'Frontend\HomeController@productDetail')->name('product.detail');
Route::get('/product/price', 'Frontend\HomeController@getProductSizeWisePrice')->name('get.product.price');
Route::get('product/search','Frontend\HomeController@searchProducts')->name('product.search');
Route::get('product/color/filter','Frontend\HomeController@searchProductsWithColor')->name('product.color.filter');
Route::get('products/filter/search','Frontend\HomeController@searchColorProduct');
Route::get('products/size/search','Frontend\HomeController@searchSizeProduct');
// cmsPages
Route::get('pages/{url}','Frontend\HomeController@cmsPages');
// contact us
Route::get('contact-us','Frontend\HomeController@ContactUs')->name('contact.use');
Route::post('contact-us','Frontend\HomeController@ContactUsSend')->name('contact.us.send');


Route::resource('cart','Frontend\CartController');
Route::get('cart/{id}/increment','Frontend\CartController@cartUpdateIncrement')->name('cart.update.icrement');
Route::get('cart/{id}/decrement','Frontend\CartController@cartUpdateDecrement')->name('cart.update.decrement');
Route::post('cart/applay/coupon','Frontend\CartController@cartApplayCoupon')->name('cart.applay.coupon');
Route::post('check/post-code','Frontend\CartController@CheckPostCode')->name('check.postal_code');


// wish list
Route::resource('wishlist','Frontend\WishlistController');
Route::post('wishlist/add-to-cart','Frontend\WishlistController@addToCart')->name('wishlist.add.to.cart');

// UserController for login register system for customer
Route::get('login-register','Frontend\UserController@loginRegisterFormShow')->name('login.register'); // show login and register form
Route::post('user-register','Frontend\UserController@RegisterStore')->name('user.register.store'); // register value store and keep login
Route::get('user/logout','Frontend\UserController@userLogout')->name('user.logout'); // user can logout from our syatem

Route::group(['middleware' => ['frontlogin']], function (){
    Route::get('user/profile','Frontend\UserController@userProfileShow')->name('user.profile'); // user can see his profile
    Route::post('user/profile/update','Frontend\UserController@userProfileUpdate')->name('user.profile.update'); // user can see his profile
    Route::post('user/password/update','Frontend\UserController@userPasswordUpdate')->name('user.password.update'); // user can see his profile
    Route::post('user/password/checked','Frontend\UserController@userPasswordChecked')->name('user.password.checked'); // user can see his profile

    // checkout pages
    Route::get('checkout','Frontend\ShippingController@index')->name('checkout.index');
    Route::post('checkout/store','Frontend\ShippingController@store')->name('checkout.store');
    Route::get('shipping/detaile/{id}','Frontend\ShippingController@ShippingDetaile')->name('shipping.detail');
    Route::post('product/order','Frontend\OrderController@Order')->name('order.store');
    Route::get('product/order/view','Frontend\OrderController@userOrderView')->name('user.order.view');
    Route::get('product/order/details/{id}','Frontend\OrderController@userOrderDetails')->name('user.order.details');
});

Route::post('user/login','Frontend\UserController@loginChack')->name('user.login.store'); // user can see his profile
Route::get('login-register/email/check','Frontend\UserController@loginRegisterEmailCheck')->name('check.email.exist');
Route::get('email/confirmation/{code}','Frontend\UserController@emailConfirmation')->name('email.confirmation');
Route::get('forgot-password','Frontend\UserController@ForgotPassword')->name('user.forgot.password');
Route::post('forgot-password','Frontend\UserController@ForgotPasswordCheck')->name('user.forgot.password.check');

// subscriber email
Route::get('subscriber/email','Frontend\UserController@CheckSubscriberEmailOrSubmit')->name('submit.subscriber.email');










