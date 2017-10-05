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

//    //user routes
//    Route::get('my_profile', [
//        'uses' => 'UserController@my_profile',
//        'as' =>'my_profile'
//    ]);

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
    Route::get('/addDos', 'AdminController@dos');
    Route::post('/addDos', 'AdminController@addDos');
    Route::get('/admin/viewUsers', 'AdminController@viewUsers');
    Route::post('/admin/deleteUser/{id}', 'AdminController@delete');
    Route::post('/admin/update/{id}', 'AdminController@update');

    /**
     * routes for all head of department operations goes here
     */
    Route::get('/addStaff', 'HodController@index');
    Route::get('/redirectBack', 'HodController@redirectBack');
    Route::post('/addStaff', 'HodController@addStaff');
    Route::get('/addProject', 'HodController@addProject');
    Route::get('/projectReport', 'HodController@projectReport');
    Route::post('/addProject', 'HodController@saveProject');
    Route::post('/projectBudget/{id}', 'HodController@saveProjectBudget');
    Route::post('/projectMoneyRequest/{id}', 'HodController@projectMoneyRequest');

    Route::get('/viewStaff', 'HodController@staff');
    Route::get('/departmentBudgetProposal', 'HodController@departmentBudgetProposal');
    Route::get('/viewAccountInfo', 'HodController@viewAccountInfo');
    Route::get('/actualBudget', 'HodController@actualBudget');
    Route::get('/viewActualBudgetInfo', 'HodController@viewActualBudgetInfo');
    Route::get('/viewProjectInfo', 'HodController@projectInfo');
    Route::get('/projectExpenditures', 'HodController@projectExpenditures');
    Route::get('/budgetProposal', 'HodController@budgetProposal');
    Route::get('/activities', 'HodController@activities');
    Route::post('/save', ['uses' => 'HodController@saveObjective', 'as' =>'/saveObjective']);
    Route::post('/save-activity', ['uses' => 'HodController@saveActivity', 'as' =>'/saveActivity']);
    Route::post('/update/{id}', ['uses' => 'HodController@modifySave', 'as' =>'/update']);
    Route::get('/editBudgetItem/{id}', 'HodController@editBudgetItem');


    Route::get('/dltStaff/{id}', ['uses'=> 'HodController@destroy', 'as' => '/dltStaff']);
    Route::get('/moreInfo/{id}', ['uses'=> 'HodController@moreInfo', 'as' => '/moreInfo']);
    Route::get('/saveAsFinal/{id}', ['uses'=> 'HodController@saveAsFinal', 'as' => '/saveAsFinal']);
    Route::get('/modify/{id}', ['uses'=> 'HodController@modify', 'as' => '/modify']);
    Route::get('/projectBudget/{id}', ['uses'=> 'HodController@projectBudget', 'as' => '/projectBudget']);
    Route::get('/requestForMoney/{id}', ['uses'=> 'HodController@requestForMoney', 'as' => '/requestForMoney']);
    Route::get('/requestApproval/{id}', ['uses'=> 'HodController@requestApproval', 'as' => '/requestApproval']);
    Route::get('/approvalProjectBudget/{id}', ['uses' =>'HodController@projectBudgetApprove', 'as' => '/approvalProjectBudget']);
    Route::post('/approvalProjectBudget/{id}', 'HodController@projectBudgetApproval');

    Route::get('/budgetDetails/{id}', ['as' => '/budgetDetails', 'uses' => 'HodController@budgetBreakdown']);

    /**
     * routes for all the accountant controller goes here
     */
    Route::get('/projectIncomes', 'AccountantController@projectIncomes');
    Route::get('/budgetIncomes', 'AccountantController@budgetIncomes');
    Route::get('/Info', 'AccountantController@Info');
    Route::get('/Accounts', 'AccountantController@viewAccounts');
    Route::get('/projectIncomes/{id}', ['uses' =>'AccountantController@addProjectIncome', 'as' => '/projectIncomes']);
    Route::get('/projectIncomesDetails/{id}', ['uses' =>'AccountantController@moreIncomeInfo', 'as' => '/projectIncomesDetails']);
    Route::get('/projectBudgetDetails/{id}', ['uses' =>'AccountantController@moreBudgetInfo', 'as' => '/projectBudgetDetails']);
    Route::get('/addAccountIncome/{id}', ['uses' =>'AccountantController@addAccIncome', 'as' => '/addAccountIncome']);
    Route::get('/approvalProjectBudget', 'AccountantController@approvalProjectBudget');
    Route::post('/projectIncomes/{id}', 'AccountantController@addProjectIncomes');
    Route::post('/saveSchoolAccount', 'AccountantController@saveAddedSchoolAccount');
    Route::post('/saveDepartmentAccount', 'AccountantController@saveAddedDepartmentAccount');
    Route::post('/accountIncomes/{id}', 'AccountantController@saveAccountIncome');
    Route::get('/addSchoolAccount', 'AccountantController@addSchoolAccount');
    Route::get('/addDepartmentAccount/{id?}', 'AccountantController@addDepartmentAccount');
    Route::get('/addAccountIncome', 'AccountantController@addAccountIncome');

    /**
     * Routes for the Dean of school
     */
    Route::get('/addStrategicDirections', 'DeanController@add_Str_Dir');
    Route::post('/editStrategicDirections', 'DeanController@edit_Str_Dir');
    Route::get('/viewAll', 'DeanController@viewAll');
    Route::get('/viewActualBudget', 'DeanController@viewActualBudget');
    Route::post('/addStrategicDirections', 'DeanController@addStrategicDirections');
    Route::get('/departmentBudget/{id?}', ['uses' =>'DeanController@departmentBudget', 'as' => '/departmentBudget']);
    Route::get('/departmentActualBudget/{id?}',['uses'=> 'DeanController@departmentActualBudget','as' => '/departmentActualBudget']);
    Route::get('/departmentBP/{id}', ['uses' =>'DeanController@getDB', 'as' => '/departmentBP']);
    Route::post('/getDepartmentId', [
        'uses' => 'DeanController@getDepartmentProposalBudget',
        'as' =>'departmentId'
    ]);


    /**
     * Routes for printing PDF'S
     */
    Route::get('/imprestPDF','ImprestController@getImprestPdf');
    Route::get('proposedBudgetReport', ['uses'=> 'DeanController@proposedBudgetReport', 'as' => 'proposedBudgetReport']);
    Route::get('viewSchoolAccounts', ['uses'=> 'AccountantController@viewSchoolAccountsPDF', 'as' => 'viewSchoolAccounts']);
    Route::get('actualBudgetReport', ['uses'=> 'DeanController@actualBudgetReport', 'as' => 'actualBudgetReport']);
    Route::get('/projectsPDF/{id}', ['uses'=> 'HodController@getProjectPdf', 'as' => '/projectsPDF']);
    Route::get('/accounts/info/print', ['uses'=> 'HodController@getAccountsInfoPdf', 'as' => '/AccountsInfoPdf']);
    Route::get('departmentBudgetProposalPDF', ['uses'=> 'HodController@departmentBudgetProposalPDF', 'as' => 'departmentBudgetProposalPDF']);
    Route::get('/departmentFinalActualBudget/{id?}', ['uses'=> 'HodController@departmentFinalActualBudget',
        'as' => '/departmentFinalActualBudget']);
    Route::post('/imprestSummaryPDF/{id}', ['uses'=> 'CashOut@getsummaryPdf', 'as' => '/imprestSummaryPDF']);

    /**
     * routes for image upload
     */
    Route::post('/update-account', [
        'uses' => 'UserController@postSaveAccount',
        'as' =>'account.save'
    ]);

    Route::get('/userimage/{filename}', [
        'uses' => 'UserController@getUserImage',
        'as' =>'account.image'
    ]);


});
