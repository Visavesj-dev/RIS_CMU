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

Route::group(['middleware' => ['auth']], function () {
    Route::get('/', 'DashboardController@index')->name('home');
    Route::get('/parent', 'DashboardController@parent');
    Route::get('/childa', 'DashboardController@childA');
    Route::get('/childb', 'DashboardController@childB');

    Route::resource('document', 'DocumentController');

    Route::resource('mou', 'MouController');
    Route::get('mou/{mou}/renew', 'MouController@renew')->name('mou.renew');


    Route::resource('moa', 'MoaController');

    Route::resource('activity', 'ActivityController');

    Route::resource('inbound-student', 'InboundStudentController');

    Route::resource('visitor', 'VisitorController');
    Route::resource('visitor/{visitor}/guest', 'GuestController')->only(['index', 'create']);
    Route::resource('guest', 'GuestController')->only([
        'store',
        'edit',
        'update',

        'destroy'

    ]);

    Route::resource('visitor/{visitor}/host', 'HostController')->only(['index', 'create']);
    Route::resource('host', 'HostController')->only([
        'store',
        'edit',
        'update',
        'destroy'
    ]);

    Route::post(
        'inbound-student/{inboundStudent}/check',
        'InboundStudentChecklistController@store'
    )->name('inbound-student.check');

    Route::resource('visa-expiration', 'VisaExpirationDateController')->only([
        'store',
        'destroy',
    ]);




    Route::resource('accommodation-report', 'ReportAccommodationController')->only([
        'store',
        'destroy',
    ]);

    Route::resource('outbound-student', 'OutboundStudentController');

    Route::post('outbound-student/{outboundStudent}/check', 'OutboundStudentChecklistController@store')->name('outbound-student.check');


    Route::resource('student-fund', 'StudentFundController')->only([
        'store',
        'destroy',
    ]);

    Route::resource('file', 'FileController')->only([
        'show',
        'destroy',
    ]);

    Route::resource('user', 'UserController');

    Route::resource('meeting', 'MeetingController');
    Route::get('meeting/{meeting}/conclude', 'MeetingConcludeController@edit')->name('meeting-conclude.edit');
    Route::put('meeting/{meeting}/conclude', 'MeetingConcludeController@update')->name('meeting-conclude.update');

    Route::resource('meeting/{meeting}/meeting-budget', 'MeetingBudgetController')->only(['index', 'create']);
    Route::resource('meeting-budget', 'MeetingBudgetController')->only([
        'store',
        'edit',
        'update',
        'destroy'
    ]);

    Route::get('meeting/department-summary', 'MeetingSummaryController@byDepartment')->name('meeting-summary.department');

    Route::get('meeting/personal-summary', 'MeetingSummaryController@byPerson')->name('meeting-summary.personal');


    Route::resource('researcher', 'ResearcherController');

  


    Route::resource('project', 'ProjectController')->only([
        'index',
        'create',
        'store',
        'edit',
        'update',


        'destroy',
        'show'
    ]);

    Route::resource('project-authorize', 'ProjectAuthorizeController')->only([
        'index',
        'create',
        'store',
        'show',
        'edit',
        'update',

        'destroy'
    ]);

    Route::resource('project-installment', 'ProjectInstallmentController');
    
    Route::resource('extend-time', 'ExtendTimeController');

    Route::get('project-summary/individual', 'ProjectSummaryController@individual')->name('project-summary.individual');

    Route::get('project-summary/department', 'ProjectSummaryController@department')->name('project-summary.department');

    Route::get('project-summary/tracking', 'ProjectSummaryController@department')->name('project-summary.tracking');

});





Route::get('/login', 'AuthController@redirectToProvider')->name('login');
Route::get('/login/callback', 'AuthController@handleProviderCallback');
Route::get('/login/dev', 'AuthController@anonymousLogin')->name('login-as-dev');
Route::get('/logout', 'AuthController@logout')->name('logout');