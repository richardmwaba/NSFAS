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

use App\Http\Controllers\ImprestController;

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

    //user routes
    Route::get('my_profile', 'UserController@my_profile');
    Route::get('/edit_profile', 'UserController@edit_profile');
    Route::post('change_password', 'PasswordController@change_password');
    Route::post('update_profile','UserController@store');

    //imprest routes
    Route::get('/imprests/new', 'ImprestController@newForm');
    Route::post('/imprests/create', 'ImprestController@create');
    Route::get('/imprests/edit/{id}', 'ImprestController@editForm');
    Route::get('/imprests/all', 'ImprestController@showAll');
    Route::post('imprests/update', 'ImprestController@update');
    Route::post('/imprests/newBudgetLine', 'ImprestController@newBudgetLine');
    Route::post('imprests/recommendation/{id}', 'ImprestController@recommendation');

    //cash out routes
    Route::post('cashout/summary', 'CashOut@cashout');
    Route::post('cashout/confirm', 'CashOut@confirm');

    //imprest retirement routes
    Route::get('/imprests/retirement/form/{id}', 'ImprestRetirementController@retirement');
    Route::post('/imprests/retirement/create', 'ImprestRetirementController@create');
    Route::post('/imprests/retirement/confirm', 'ImprestRetirementController@confirm');
    Route::post('/imprests/retirement/edit/{id}', 'ImprestRetirementController@edit');
    Route::post('/imprests/retirement/update/{id}', 'ImprestRetirementController@update');

    /**
     * routes for all admin operations goes here
     */
    Route::get('/addHod', 'AdminController@index');
    Route::post('/addHod', 'AdminController@addHOD');
    Route::get('/addAccountant', 'AdminController@getAcc');
    Route::post('/addAccountant', 'AdminController@addAccountant');
    Route::get('/addDos', 'AdminController@dean');
    Route::post('/addDos', 'AdminController@addDos');

    /**
     * routes for all head of department operations goes here
     */
    Route::get('/addStaff', 'HodController@index');
    Route::post('/addStaff', 'HodController@addStaff');
    Route::get('/addProject', 'HodController@addProject');
    Route::get('/projectReport', 'HodController@projectReport');
    Route::post('/addProject', 'HodController@saveProject');
    Route::post('/projectBudget/{id}', 'HodController@saveProjectBudget');
    Route::post('/projectMoneyRequest/{id}', 'HodController@projectMoneyRequest');

    Route::get('/viewStaff', 'HodController@staff');
    Route::get('/departmentBudgetProposal', 'HodController@departmentBudgetProposal');
    Route::get('/viewBudget', 'HodController@viewBudget');
    Route::get('/viewProjectInfo', 'HodController@projectInfo');
    Route::get('/projectExpenditures', 'HodController@projectExpenditures');
    Route::get('/budgetProposal', 'HodController@budgetProposal');
    Route::get('/activities', 'HodController@activities');
    Route::post('/save', [
        'uses' => 'HodController@saveObjective',
        'as' =>'/saveObjective'
    ]);
    Route::post('/save-activity', [
        'uses' => 'HodController@saveActivity',
        'as' =>'/saveActivity'
    ]);

    Route::get('/dltStaff/{id}', ['uses'=> 'HodController@destroy', 'as' => '/dltStaff']);
    Route::get('/projectBudget/{id}', ['uses'=> 'HodController@projectBudget', 'as' => '/projectBudget']);
    Route::get('/requestForMoney/{id}', ['uses'=> 'HodController@requestForMoney', 'as' => '/requestForMoney']);
    Route::get('/requestApproval/{id}', ['uses'=> 'HodController@requestApproval', 'as' => '/requestApproval']);
    Route::get('/editStaff/{id}', ['uses' =>'HodController@edit', 'as' => '/editStaff']);
    Route::get('/approvalProjectBudget/{id}', ['uses' =>'HodController@projectBudgetApprove', 'as' => '/approvalProjectBudget']);
    Route::post('/approvalProjectBudget/{id}', 'HodController@projectBudgetApproval');

    /**
     * routes for all the accountant controller goes here
     */
    Route::get('/projectIncomes', 'AccountantController@projectIncomes');
    Route::get('/budgetIncomes', 'AccountantController@budgetIncomes');
    Route::get('/Info', 'AccountantController@Info');
    Route::get('/viewAccounts', 'AccountantController@viewAccounts');
    Route::get('/projectIncomes/{id}', ['uses' =>'AccountantController@addProjectIncome', 'as' => '/projectIncomes']);
    Route::get('/projectIncomesDetails/{id}', ['uses' =>'AccountantController@moreIncomeInfo', 'as' => '/projectIncomesDetails']);
    Route::get('/projectBudgetDetails/{id}', ['uses' =>'AccountantController@moreBudgetInfo', 'as' => '/projectBudgetDetails']);
    Route::get('/approvalProjectBudget', 'AccountantController@approvalProjectBudget');

    Route::post('/projectIncomes/{id}', 'AccountantController@addProjectIncomes');
//    Route::post('/approvalProjectBudget', 'AccountantController@approvalProjectBudgetInfo');
//    Route::post('/projectBudgetApproval/{id}', 'AccountantController@projectBudgetApproval');

    /**
     * Routes for the Dean of school
     */
    Route::get('/addStrategicDirections', 'DeanController@add_Str_Dir');
    Route::get('/viewAll', 'DeanController@viewAll');
    Route::post('/addStrategicDirections', 'DeanController@addStrategicDirections');
    Route::get('/departmentBudget/{id?}', ['uses' =>'DeanController@departmentBudget', 'as' => '/departmentBudget']);
    Route::get('/departmentActualBudget', 'DeanController@departmentBudget');
    Route::get('/departmentBP/{id}', ['uses' =>'DeanController@getDB', 'as' => '/departmentBP']);
    Route::post('/getDepartmentId', [
        'uses' => 'DeanController@getDepartmentProposalBudget',
        'as' =>'departmentId'
    ]);


    /**
     * Routes for printing PDF'S
     */
    Route::get('/imprestPDF','ImprestController@getImprestPdf');

    Route::get('/projectsPDF/{id}', ['uses'=> 'HodController@getProjectPdf', 'as' => '/projectsPDF']);

    Route::post('/imprestSummaryPDF/{id}', ['uses'=> 'CashOut@getsummaryPdf', 'as' => '/imprestSummaryPDF']);


});
