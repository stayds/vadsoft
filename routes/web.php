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

Route::get('/', 'Auth\LoginController@showLoginForm')->name('site');

Auth::routes(['verify'=>true]);

    Route::get('/admin/login','Auth\LoginAdminController@showAdminLoginForm')->name('get.admin.login');
    Route::post('/admin/login/post','Auth\LoginAdminController@adminLogin')->name('post.admin.login');
    Route::get('/admin/dashboard','Admin\AdminController@index')->name('get.admin.dashboard');
    Route::post('/logout/admin', 'Auth\LoginAdminController@adminLogout')->name('admin.logout');
    Route::get('/admin/changepassword', 'Admin\AdminController@changePassword')->name('get.change.password');
    Route::post('/admin/changepassword/post', 'Admin\AdminController@changePasswordPost')->name('post.change.password');
    Route::get('/client/detail', 'Admin\ClientController@index')->name('get.client.detail');
    Route::post('/client/update', 'Admin\ClientController@update')->name('post.client.update');
    Route::get('/client/add', 'Admin\ClientController@create')->name('get.client.create');
    Route::get('/client/renew', 'Admin\ClientController@renewClient')->name('get.client.renew');
    Route::post('/client/renew/post', 'Admin\ClientController@renewClientPost')->name('post.client.renew');
    Route::post('/client/add/post', 'Admin\ClientController@store')->name('post.client.create');
    Route::get('/client/organisation/add', 'Admin\OrganController@create')->name('get.client.organisation.create');
    Route::post('/client/organisation/post', 'Admin\OrganController@store')->name('post.client.organisation.create');
    Route::get('/create/licence/', 'Admin\LicenceController@create')->name('get.licence.create');
    Route::get('/licence/list', 'Admin\LicenceController@index')->name('get.licence.list');
    Route::get('/licence/status/{id}', 'Admin\LicenceController@destroy')->name('get.licence.status');
    Route::post('/create/licence/post', 'Admin\LicenceController@store')->name('post.licence.create');

    Route::get('/home', 'HomeController@index')->name('home');

    Route::post('/reset/password', 'Auth\ForgotPasswordController@postForgotten')->name('pass.reset');
    Route::get('/forgot/password', 'Auth\ForgotPasswordController@index')->name('pass.forgot');


    Route::get('/staff/disable','Staff\StaffController@disable')->name('get.staff.disable');
    Route::get('/staff/create','Staff\StaffController@create')->name('get.staff.create');
    Route::get('/staff/change/password','Staff\StaffController@changePassword')->name('get.staff.password');
    Route::post('/staff/change/post','Staff\StaffController@changePasswordPost')->name('post.staff.password');
    Route::get('/staff/list','Staff\StaffController@index')->name('get.staff.list');
    Route::get('/staff/profile/edit','Staff\StaffController@show')->name('get.staff.profile');
    Route::get('/staff/profile/edit/post','Staff\StaffController@update')->name('post.staff.profile');
    Route::get('/staff/supervisor','Staff\StaffController@setSupervisor')->name('get.staff.supervisor');
    Route::post('/staff/supervisor/post','Staff\StaffController@setSupervisorPost')->name('post.staff.supervisor');
    Route::get('/staff/supervisor/list', 'Staff\StaffController@getSupervisor')->name('get.staff.supervisor.list');
    Route::get('/staff/supervisor/disable/{id}', 'Staff\StaffController@disableSupervisor')->name('staff.supervisor.disable');
    Route::get('/staff/disable/{id}', 'Staff\StaffController@destroy')->name('get.staff.disable');


    Route::get('/department/create','Department\DepartmentController@create')->name('get.department.create');
    Route::get('/department/list','Department\DepartmentController@index')->name('get.department.list');
    Route::post('/department/post','Department\DepartmentController@store')->name('post.department.create');
    Route::get('/department/supervisor','Department\DepartmentController@setSupervisor')->name('get.department.supervisor');
    Route::post('/department/supervisor/post','Department\DepartmentController@setSupervisorPost')->name('post.department.supervisor');
    Route::get('/department/supervisor/list','Department\DepartmentController@getSupervisor')->name('get.department.supervisor.list');
    Route::get('/department/supervisor/disable/{id}/{userid}','Department\DepartmentController@disableSupervisor')->name('department.supervisor.disable');
    Route::get('/department/disable/{id}','Department\DepartmentController@destroy')->name('get.department.disable');

    Route::post('/organisation/create/post','OrganisationController@store')->name('post.organisation.create');
    Route::get('/organisation/list','OrganisationController@index')->name('get.organisation.list');
    Route::get('/organisation/disable/{id}','OrganisationController@disableSupervisor')->name('get.organisation.disable');
    Route::get('/organisation/edit/{id}','OrganisationController@show')->name('get.organisation.edit');
    Route::post('/organisation/edit','OrganisationController@update')->name('post.organisation.edit');
    Route::get('/organisation/create','OrganisationController@create')->name('get.organisation.create');


    Route::prefix('unit')->group(function (){
        Route::get('/create','Unit\UnitController@create')->name('get.unit.create');
        Route::get('/list','Unit\UnitController@index')->name('get.unit.list');
        Route::get('/staff','Unit\UnitController@addStaff')->name('get.unit.staff');
        Route::post('/post','Unit\UnitController@store')->name('post.unit.create');
        Route::post('/staff/post','Unit\UnitController@setStaffPost')->name('post.unit.staff');
        Route::get('/add/supervisor','Unit\UnitController@setSupervisor')->name('get.unit.supervisor');
        Route::post('/add/supervisor/post','Unit\UnitController@setSupervisorPost')->name('post.unit.supervisor');
        Route::get('/supervisor/list','Unit\UnitController@getSupervisor')->name('get.unit.supervisor.list');
        Route::get('/supervisor/disable/{id}/{userid}','Unit\UnitController@disableSupervisor')->name('unit.supervisor.disable');
    });

    Route::get('/assessment/type','AssessmentController@index')->name('get.assessment.list');
    Route::get('/assessment/create','AssessmentController@create')->name('get.assessment.create');
    Route::post('/assessment/create/post','AssessmentController@store')->name('post.assessment.create');

    Route::get('/assessment/category','AssessmentController@categoryList')->name('get.assessment.category.list');
    Route::get('/assessment/category/create','AssessmentController@categoryCreate')->name('get.assessment.category.create');
    Route::post('/assessment/category/create/post','AssessmentController@categoryStore')->name('post.assessment.category.create');

    Route::get('/kpi/list','KpiController@index')->name('get.kpi.list');
    Route::get('/kpi/create','KpiController@create')->name('get.kpi.create');
    Route::post('/kpi/create/post','KpiController@store')->name('post.kpi.create');

    Route::get('/measure/staff','Staff\MeasureController@index')->name('get.measure.staff');
    Route::get('/measure/staff/entry/{id}/{type}','Staff\MeasureController@staffMeasureEntry')->name('get.measure.staff.entry');
    Route::post('/measure/staff/post','Staff\MeasureController@store')->name('post.measure.staff');
    Route::post('/measure/staff/entry/post','Staff\MeasureController@staffMeasureEntryPost')->name('post.measure.staff.entry');
    Route::get('/measure/staff/delete/{id}','Staff\MeasureController@destory')->name('get.staff.measure.delete');
    Route::get('/measure/staff/entry/{measureid}/approve/{approve}/{deptstateid}','Staff\MeasureController@dataApproved')->name('get.measure.staff.approve');
    Route::get('/measure/staff/{measureid}/entry/{approve}/approve/{deptstateid}/{historyid}','Staff\MeasureController@dataApproved')->name('get.measure.staff.approve');
    Route::get('/measure/staff/{measureid}/supervisor/{historyid}','Staff\MeasureController@dataView')->name('get.measure.staff.supervisor');

    Route::get('/measure/department','Department\MeasureController@index')->name('get.measure.depart');
    Route::get('/measure/department/delete/{id}','Department\MeasureController@destory')->name('get.department.measure.delete');
    Route::post('/measure/department/post','Department\MeasureController@store')->name('post.measure.depart');
    Route::get('/measure/department/entry/{id}/{type}','Department\MeasureController@deptMeasureEntry')->name('get.measure.department.entry');
    Route::post('/measure/department/entry/post','Department\MeasureController@deptMeasureEntryPost')->name('post.measure.department.entry');
    Route::get('/measure/department/{measureid}/entry/{approve}/approve/{deptstateid}/{historyid}','Department\MeasureController@dataApproved')->name('get.measure.department.approve');
    Route::get('/measure/department/{measureid}/supervisor/{historyid}','Department\MeasureController@dataView')->name('get.measure.department.supervisor');

    Route::get('/measure/unit','Unit\MeasureController@index')->name('get.measure.unit');
    Route::post('/measure/unit/post','Unit\MeasureController@store')->name('post.measure.unit');
    Route::get('/measure/unit/entry/{id}','Unit\MeasureController@unitMeasureEntry')->name('get.measure.unit.entry');
    Route::post('/measure/unit/entry/post','Unit\MeasureController@unitMeasureEntryPost')->name('post.measure.unit.entry');
    Route::get('/measure/unit/delete/{id}','Unit\MeasureController@destory')->name('get.unit.measure.delete');
    Route::get('/measure/unit/entry/{measureid}/approve/{approve}/{deptstateid}','Unit\MeasureController@dataApproved')->name('get.measure.unit.approve');
    Route::get('/measure/unit/{measureid}/entry/{approve}/approve/{deptstateid}/{historyid}','Unit\MeasureController@dataApproved')->name('get.measure.unit.approve');
    Route::get('/measure/unit/{measureid}/supervisor/{historyid}','Unit\MeasureController@dataView')->name('get.measure.unit.supervisor');

    Route::get('/report/staff/','Staff\ReportController@index')->name('get.staff.report');
    Route::get('/report/department/','Department\ReportController@index')->name('get.department.report');
    Route::get('/report/unit/','Unit\ReportController@index')->name('get.unit.report');
    Route::get('/report/organisation/','OrganisationController@report')->name('get.organisation.report');


