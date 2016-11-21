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
    Route::get('/imprests/new', 'ImprestController@newForm');
    Route::post('/imprests/create', 'ImprestController@create');
    Route::get('/imprests/edit/{id}', 'ImprestController@editForm');
    Route::get('/imprests/all', 'ImprestController@showAll');
    Route::post('imprests/update', 'ImprestController@update');
    Route::post('/imprests/newBudgetLine', 'ImprestController@newBudgetLine');
    Route::post('imprests/recommendation/{id}', 'ImprestController@recommendation');

    Route::get('/imprests/retirement/form/{id}', 'ImprestRetirementController@retirementForm');
    Route::post('cashout/summary', 'CashOut@cashout');
    Route::post('cashout/confirm', 'CashOut@confirm');

});
