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

    Route::post('cashout/summary', 'CashOut@cashout');
    Route::post('cashout/confirm', 'CashOut@confirm');

    Route::get('/imprests/retirement/form/{id}', 'ImprestRetirementController@retirementForm');
    Route::post('/imprests/retirement/create', 'ImprestRetirementController@create');
    Route::post('/imprests/retirement/edit/{id}', 'ImprestRetirementController@edit');
    Route::post('/imprests/retirement/update/{id}', 'ImprestRetirementController@update');

    /**
     * routes for all admin operations goes here
     */
    Route::get('/addHod', 'AdminController@index');
    Route::post('/addHod', 'AdminController@addHOD');
    Route::get('/addAccountant', 'AdminController@getAcc');
    Route::post('/addAccountant', 'AdminController@addAccountant');
    Route::get('/addDos', 'AdminController@dos');
    Route::post('/addDos', 'AdminController@addDos');

    /**
     * routes for all head of department operations goes here
     */
    Route::get('/addStaff', 'HodController@index');
    Route::post('/addStaff', 'HodController@addStaff');
    Route::get('/addProject', 'HodController@addProject');
    Route::post('/addProject', 'HodController@saveProject');
//    Route::get('/projectBudgeting/{id}', 'HodController@projectBudget');
//    Route::post('/projectBudgeting/{id}', 'HodController@saveProjectBudget');
    Route::post('/projectBudget/{id}', 'HodController@saveProjectBudget');
    Route::post('/projectMoneyRequest/{id}', 'HodController@projectMoneyRequest');

    Route::get('/viewStaff', 'HodController@staff');
    Route::get('/viewBudget', 'HodController@viewBudget');
    Route::get('/viewProjectInfo', 'HodController@projectInfo');
    Route::get('/projectExpenditures', 'HodController@projectExpenditures');

    Route::get('/dltStaff/{id}', ['uses'=> 'HodController@destroy', 'as' => '/dltStaff']);
    Route::get('/projectBudget/{id}', ['uses'=> 'HodController@projectBudget', 'as' => '/projectBudget']);
    Route::get('/requestForMoney/{id}', ['uses'=> 'HodController@requestForMoney', 'as' => '/requestForMoney']);
    Route::get('/requestApproval/{id}', ['uses'=> 'HodController@requestApproval', 'as' => '/requestApproval']);
    Route::get('/editStaff/{id}', ['uses' =>'HodController@edit', 'as' => '/editStaff']);

    /**
     * routes for all the accountant controller goes here
     */
    Route::get('/projectIncomes', 'AccountantController@projectIncomes');
    Route::get('/budgetIncomes', 'AccountantController@budgetIncomes');
    Route::get('/Info', 'AccountantController@Info');
    Route::get('/approvalProjectBudget/{id}', ['uses' =>'AccountantController@approvalProjectBudgetInfo', 'as' => '/approvalProjectBudget']);
    Route::get('/projectIncomes/{id}', ['uses' =>'AccountantController@addProjectIncome', 'as' => '/projectIncomes']);
    Route::get('/projectIncomesDetails/{id}', ['uses' =>'AccountantController@moreIncomeInfo', 'as' => '/projectIncomesDetails']);
    Route::get('/projectBudgetDetails/{id}', ['uses' =>'AccountantController@moreBudgetInfo', 'as' => '/projectBudgetDetails']);
    Route::get('/approvalProjectBudget/{id}', ['uses' =>'AccountantController@projectBudgetApproval', 'as' => '/approvalProjectBudget']);
    Route::get('/approvalProjectBudget', 'AccountantController@approvalProjectBudget');

    Route::post('/projectIncomes/{id}', 'AccountantController@addProjectIncomes');
//    Route::post('/approvalProjectBudget', 'AccountantController@approvalProjectBudgetInfo');
//    Route::post('/projectBudgetApproval/{id}', 'AccountantController@projectBudgetApproval');



});
