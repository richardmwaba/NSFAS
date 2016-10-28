<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::group(['middleware' => ['web']], function () {
    /**
     * All the routes bellow can be accessed by an unauthenticated user who visits our site
     */
    Route::get('/', function () {
        return view('login');
    });
});

Route::auth();

/**
 * All routes included in the bellow route grouping will be accessed only by authenticated
 * users that's both registered companies and customers
 */
Route::group(['middleware' => 'auth'], function () {

    Route::get('/home', 'HomeController@index');

});
