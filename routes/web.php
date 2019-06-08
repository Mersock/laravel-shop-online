<?php
//font
Route::get('/','FrontController@index')->name('home');
##แบ่งหน้า###
Route::get('/pagination','FrontController@homePage');
##แบ่งหน้า###

// Route::get('/detail','FrontController@detail')->name('detail');
// Route::get('/admin','FrontController@admin')->name('admin');

Auth::routes();

//Route::get('/home', 'HomeController@index');

//cart
Route::resource('/cart', 'Cartcontroller');
Route::get('/cart/add-item/{id}','Cartcontroller@addItems')->name('cart.addItem');


//admin
Route::group(['prefix'=>'admin','middleware'=>['auth','admin']],function(){
    Route::get('/',function(){
        return view('admin.index');
    })->name('admin.index');
    //Product
    Route::get('/product','ProductsController@index')->name('product.index');
    Route::post('/product/store','ProductsController@store')->name('product.store');
    Route::post('/product/destroy','ProductsController@destroy')->name('product.destroy');
    Route::get('/product/read-data','ProductsController@readData')->name('product.read-data');
    Route::get('/product/edit','ProductsController@edit')->name('product.edit');
    Route::post('/product/update','ProductsController@update')->name('product.update');
    Route::get('/product/show','ProductsController@view')->name('product.show');
    ##แบ่งหน้า###
    Route::get('/product/page/pagination','ProductsController@productPage');
    ##แบ่งหน้า###
    //Product
    //order
    Route::get('/orders/{type?}','OrderController@orders')->name('orders.index');
    Route::post('/orders-update/{orderId}','OrderController@setOrders')->name('orders.status');

    //Category
    Route::resource('/category','CategoriesController');

});

// Route::get('/checkout','CheckoutController@checkAuth')->name('checkout');
// checkout
Route::group(['middleware'=>['auth']],function(){

    Route::get('/shipping','CheckoutController@shipping')->name('checkout.shipping');
    Route::get('/order-history','OrderController@orderUser')->name('order.history');
});

//ที่อยู่
Route::resource('/address', 'AddressController');

//payment
Route::get('/payment','CheckoutController@payment')->name('checkout.payment');
Route::post('/store-payment','CheckoutController@storePayment')->name('payment.store');

