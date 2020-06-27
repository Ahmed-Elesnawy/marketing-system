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




Route::name('dashboard.')

       ->middleware(['auth','pending'])

       ->group(function(){

        Route::get('home','HomeController@index')->name('home');

        /**
         * Users Crude Routes 
         * 
         */

         Route::resource('users','UserController')->except(['show'])->middleware('admin');

         /**
         * Categories Crude Routes
         *
         */

         Route::resource('categories', 'CategoryController')->except(['show'])->middleware('admin');

         /**
         * colors Crude Routes
         *
         */

         Route::resource('colors', 'ColorController')->except(['show'])->middleware('admin');

        

         /**
         * Provinces Crude Routes
         *
         */

         Route::resource('provinces', 'ProvinceController')->except(['show'])->middleware('admin');

        /**
         * Products Crude Routes
         *
         */

         Route::get('products','ProductController@index')->name('products.index');
         Route::resource('products', 'ProductController')->except(['show','index'])->middleware('admin');

        

         /**
          * Tech Cards Routes
          */

        
        Route::resource('tech-cards','TechCardController');
        Route::put('cards/{id}/reply','TechCardController@replyCard')->name('tech-cards.reply');

         /**
         * Orders Crude Routes
         *
         */

         Route::resource('orders', 'OrderController')->except(['create']);
         Route::put('orders/{order}/change/status','OrderController@changeStatus')->name('orders.change');
         Route::put('orders/{order}/cancel','OrderController@cancelOrder')->name('orders.cancel');
         Route::put('orders/{order}/discard','OrderController@discardOrder')->name('orders.discard')->middleware('admin');
         Route::put('orders/{order}/{product}/remove','OrderController@removeProduct')->name('orders.removeProduct');


         Route::put('orders/{order}/{product}/plus','QtyController@plus')->name('orders.plus_qty');
         Route::put('orders/{order}/{product}/minus','QtyController@minus')->name('orders.minus_qty');



         /**
          * Money Requests Routes 
          *
         */


        Route::post('money-requests','MoneyRequestController@store')->name('requests.store');
        Route::put('money-requests/{moneyRequest}','MoneyRequestController@update')->name('requests.update');
        Route::get('money-requests','MoneyRequestController@index')->name('requests.index')->middleware('admin');
        Route::delete('money-requests/{moneyRequest}/cancel','MoneyRequestController@cancelRequest')->name('requests.cancel')->middleware('admin');
        Route::put('money-requests/{moneyRequest}/confirm','MoneyRequestController@confirmRequest')->name('requests.confirm')->middleware('admin');



         /**
          * Markter Routes
          *
          */

          Route::get('my-orders','MarkterController@orders')->name('markter.orders');
          Route::get('my-wallet','MarkterController@wallet')->name('markter.wallet');
          Route::get('my-cards','MarkterController@myCards')->name('markter.myCards');


          /** 
           * Edit Profile Route
          */

          Route::get('profile','UserController@showEditProfileForm')->name('users.editProfile');
          Route::put('profile','UserController@updateProfile')->name('users.updateProfile');
          Route::get('change/password','UserController@changePasswordForm')->name('users.changePasswordForm');
          Route::put('change/password','UserController@changePassword')->name('users.changePassword');

          /**
           * Cart Routes
           * 
           */
          
          Route::get('cart','CartController@cart')->name('cart')->middleware('notEmpty');
          Route::put('cart/{product}/add','CartController@addToCart')->name('cart.add');
          Route::put('cart/{id}/update','CartController@updateItem')->name('cart.updateItem');
          Route::put('cart/{id}/clear','CartController@clearItem')->name('cart.clearItem');
          Route::put('cart/clear','CartController@clearCart')->name('cart.clear');

          /**
           * Reports Routes
           * 
           */

          Route::resource('reports','ReportController')->only(['index','store','destroy'])->middleware('admin');

           /**
           * Reports Routes
           * 
           */

          Route::resource('messages','MessageController');

          /**
           * Notifications Routes
           * 
          */
          Route::get('read/notifications','NotificationController@readNotification')->name('notification.read');
          Route::get('notifications','NotificationController@index')->name('notifications.index');
     });





Auth::routes();

route::get('pending',function(){

    return view('auth.pending');

})->name('auth.pending')->middleware(['auth','active']);




