<?php

use Illuminate\Http\Request;


Route::group(['prefix' => 'auth'], function () {
    //Por defecto 'auth'='web'
    Route::post('login', 'AuthController@login');
    Route::post('signup', 'AuthController@signup');
    Route::post('searchRef', 'ReferentesController@searchRef');

    Route::group(['middleware' => 'auth:api'], function() {
        Route::get('logout', 'AuthController@logout');
        Route::get('user', 'AuthController@user');
        Route::post('cart', 'ProductController@product');
        Route::get('admin', 'AdminController@index');

        Route::get('cart/show', 'CartController@showCart');

        Route::bind('producto', function($slug){
           return App\Producto::where('slug',$slug)->first();  
        });
        Route::get('cart/addItem/{producto}', 'CartController@addItem');
        Route::get('cart/update/{producto}/cantidad', 'CartController@updateCantidad');

        Route::get('cart/total', 'CartController@total');

        Route::get('cart/deleteItem/{producto}', 'CartController@deleteItem');
        Route::get('cart/trash/{producto}', 'CartController@trash');


        

        

        

    });
});


//  Puedo acceder a la sección de productos solo si estoy loggeado en la api
Route::group(['prefix'=>'productos','middleware' => 'auth:api'], function() {
    Route::get('producto', 'ProductController@product');
}); 


