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

        

    });
});


//  Puedo acceder a la sección de productos solo si estoy loggeado en la api
Route::group(['prefix'=>'productos','middleware' => 'auth:api'], function() {
    Route::get('producto', 'ProductController@product');
}); 


