<?php

use Illuminate\Support\Facades\Route;

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



Auth::routes([
    'register' => false,
    'verify' => true,
]);

Route::group(['middleware' => ['auth']], function () {
    Route::get('/', 'Admin\AdminController@index');
    Route::get('/users/create', 'Admin\UserController@create')->middleware('permission:add-user');
    Route::POST('/users', 'Admin\UserController@store')->middleware('permission:add-user');
    Route::get('/users', 'Admin\UserController@index')->middleware('permission:view-user');
    Route::get('/users/{id}/edit', 'Admin\UserController@edit')->middleware('permission:edit-user');
    Route::PATCH('/users/{id}', 'Admin\UserController@update')->middleware('permission:edit-user');
    Route::DELETE('/users/{id}', 'Admin\UserController@destroy')->middleware('permission:delete-user');
    Route::get('/user-settings', 'Admin\UserController@userSettings');
    Route::POST('/change-password', 'Admin\UserController@changePassword');
    Route::PATCH('/change-user-image', 'Admin\UserController@changeUserImage');
});

Route::resource('platforms', 'Admin\\PlatformsController');
Route::resource('clients', 'Admin\\ClientsController');
Route::resource('project-statuses', 'Admin\\ProjectStatusesController');
Route::resource('task-statuses', 'Admin\\TaskStatusesController');
Route::resource('job-types', 'Admin\\JobTypesController');
Route::resource('departments', 'Admin\\DepartmentsController');
Route::resource('designations', 'Admin\\DesignationsController');
Route::resource('projects', 'Admin\\ProjectsController');
Route::resource('project-notes', 'Admin\\ProjectNotesController');
Route::DELETE('/delete-all-project-notes-for-particular-project/{id}', 'Admin\\ProjectNotesController@deleteAllNotesForParticularProject');
Route::resource('employees', 'Admin\\EmployeesController');
Route::POST('/delete-certificate', 'Admin\EmployeesController@deleteCertificate');
Route::resource('leave-managements', 'Admin\\LeaveManagementsController');

Route::get('/leave-managements', 'Admin\LeaveManagementsController@index')->middleware('permission:view-leave');
Route::get('/leave-managements/create', 'Admin\LeaveManagementsController@create');
Route::POST('/leave-managements', 'Admin\LeaveManagementsController@store');
Route::get('/leave-managements/{unique_key}/edit', 'Admin\LeaveManagementsController@edit');
Route::PATCH('/leave-managements/{unique_key}', 'Admin\LeaveManagementsController@update');
Route::DELETE('/leave-managements/{unique_key}', 'Admin\LeaveManagementsController@destroy');
Route::get('/my-leave-applications-pending', 'Admin\LeaveManagementsController@myLeaveApplicationPending');
Route::get('/my-leave-applications-summary', 'Admin\LeaveManagementsController@myLeaveApplicationSummary');

Route::get('/leave-pending-unique-user/{emp_id}', 'Admin\LeaveManagementsController@leavePendingUniqueUser')->middleware('permission:view-leave');
Route::get('/leave-approved-unique-user/{emp_id}', 'Admin\LeaveManagementsController@leaveApprovedUniqueUser')->middleware('permission:view-leave');
Route::get('/leave-rejected-unique-user/{emp_id}', 'Admin\LeaveManagementsController@leaveRejectedUniqueUser')->middleware('permission:view-leave');

Route::get('/approve-leave-single/{id}/{emp_id}', 'Admin\LeaveManagementsController@approveLeaveSingle')->middleware('permission:approval-leave');
Route::get('/reject-leave-single/{id}/{emp_id}', 'Admin\LeaveManagementsController@rejectLeaveSingle')->middleware('permission:approval-leave');
Route::get('/approve-leave-all/{emp_id}', 'Admin\LeaveManagementsController@approveLeaveAll')->middleware('permission:approval-leave');
Route::get('/reject-leave-all/{emp_id}', 'Admin\LeaveManagementsController@rejectLeaveAll')->middleware('permission:approval-leave');

Route::get('/approved-leave-lists', 'Admin\LeaveManagementsController@approvedLeaveList')->middleware('permission:view-leave');
Route::get('/rejected-leave-lists', 'Admin\LeaveManagementsController@rejectedLeaveList')->middleware('permission:view-leave');

