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
/* FrontEnd Location */
Route::get('/','IndexController@index');
Route::get('/list-products','IndexController@shop');
Route::get('/cat/{id}','IndexController@listByCat')->name('cats');
Route::get('/product-detail/{id}','IndexController@detialpro');
////// get Attribute ////////////
Route::get('/get-product-attr','IndexController@getAttrs');
///// Cart Area /////////
Route::post('/addToCart','CartController@addToCart')->name('addToCart');
Route::post('/search','IndexController@search');
Route::get('/viewcart','CartController@index');
Route::get('/cart/deleteItem/{id}','CartController@deleteItem');
Route::get('/cart/update-quantity/{id}/{quantity}','CartController@updateQuantity');
Route::get('/contact','IndexController@contact');
Route::get('/viewavailableshops','ApplicationController@viewavailableshops');
Route::get('/apply_shop/{id}','ApplicationController@apply_shop');
Route::resource('/application','ApplicationController');
Route::get('/showapplications0','ApplicationController@showapplications0');
Route::get('/showapplications1','ApplicationController@showapplications1');
Route::get('/giveShop/{id}','ApplicationController@giveShop');
Route::get('/application/givetime/{id}','ApplicationController@givetime');
Route::get('/deleteApplication/{id}','ApplicationController@deleteApplication');
Route::post('/prodreview','ProductAtrrController@addreview');
/////////////////////////
/// Apply Coupon Code
Route::post('/apply-coupon','CouponController@applycoupon');
/// Simple User Login /////
Route::get('/login_page','UsersController@index');
Route::post('/register_user','UsersController@register');
Route::post('/user_login','UsersController@login');
Route::get('/logout','UsersController@logout');

/// Shopowner Login /////
// Route::get('/login_shopowner','ShopownerController@loginPage');
// Route::post('/login_so','ShopownerController@login');
// Route::get('/logout_shopowner','ShopownerController@logout');

////// User Authentications ///////////
Route::group(['middleware'=>'FrontLogin_middleware'],function (){
    Route::get('/myaccount','UsersController@account');
    Route::put('/update-profile/{id}','UsersController@updateprofile');
    Route::put('/update-password/{id}','UsersController@updatepassword');
    Route::get('/check-out','CheckOutController@index');
    Route::get('/prev_orders','UsersController@prev_orders');
    Route::post('/submit-checkout','CheckOutController@submitcheckout');
    Route::get('/order-review','OrdersController@index');
    Route::post('/submit-order','OrdersController@order');
    Route::get('/cod/{orid}','OrdersController@cod');
    Route::get('/paypal','OrdersController@paypal');
    Route::post('/download','OrdersController@download');
});
///




/* Admin Location */
Auth::routes(['register'=>false]);
Route::get('/home', 'HomeController@index')->name('home');
Route::group(['prefix'=>'admin','middleware'=>['auth','admin']],function (){
    Route::get('/', 'AdminController@index')->name('admin_home');
    /// Setting Area
    Route::get('/settings', 'AdminController@settings');
    Route::get('/check-pwd','AdminController@chkPassword');
    Route::post('/update-pwd','AdminController@updatAdminPwd');
    /// Category Area
    Route::resource('/category','CategoryController');
    Route::get('delete-category/{id}','CategoryController@destroy');
    Route::get('/check_category_name','CategoryController@checkCateName');
    /// Shop Area
    Route::resource('/shop','ShopController');
    Route::get('delete-shop/{id}','ShopController@destroy');
    //Route::get('/check_shop_id','ShopController@checkCateName');
    /// Products Area
    Route::resource('/product','ProductsController');
    Route::get('delete-product/{id}','ProductsController@destroy');
    Route::get('delete-image/{id}','ProductsController@deleteImage');
    /// Product Attribute
    Route::resource('/product_attr','ProductAtrrController');
    Route::get('delete-attribute/{id}','ProductAtrrController@deleteAttr');
    /// Product Images Gallery
    Route::resource('/image-gallery','ImagesController');
    Route::get('delete-imageGallery/{id}','ImagesController@destroy');
    /// ///////// Coupons Area //////////
    Route::resource('/coupon','CouponController');
    Route::get('delete-coupon/{id}','CouponController@destroy');
    ////order area
    Route::resource('/orders','OrdersController');
    Route::get('/orders/show/{id}','OrdersController@show');
    Route::get('orders/assign/{id}','OrdersController@assign');
    Route::get('delete-order/{id}','OrdersController@destroy');
///
});


/* Shopwner Location */
// Route::group(['prefix'=>'shopowner','middleware'=>'Shopowner'],function (){
Route::group(['prefix'=>'shopowner','middleware'=>['auth','Shopowner']],function (){
    Route::get('/','ShopownerController@index')->name('Shopowner_home');
    ///setting area 
    Route::get('/settings', 'ShopownerController@settings');
    Route::get('/check-pwd','ShopownerController@chkPassword');
    Route::post('/update-pwd','ShopownerController@updatSOPwd');
    /// Category Area
    // // Route::resource('/category','CategoryController');
    // Route::post('/category/store','CategoryController@store');
    // Route::get('/category/create','CategoryController@create');
    // Route::get('/category/index','CategoryController@index');
    
    // Route::get('/category/edit/{id}','CategoryController@edit');
    // Route::get('delete-category/{id}','CategoryController@destroy');
    // Route::get('/check_category_name','CategoryController@checkCateName');
    // Route::post('/category/update/{id}','CategoryController@update');
    // /// Products Area
    // // Route::resource('/product','ProductsController');
    // Route::get('shopowner/delete-product/{id}','ProductsController@destroy');
    // Route::get('shopowner/delete-image/{id}','ProductsController@deleteImage');
});



