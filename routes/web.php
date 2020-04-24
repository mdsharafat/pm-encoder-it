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

    Route::resource('platforms', 'Admin\\PlatformsController');
    Route::resource('clients', 'Admin\\ClientsController');
    Route::resource('departments', 'Admin\\DepartmentsController');
    Route::resource('designations', 'Admin\\DesignationsController');
    Route::resource('projects', 'Admin\\ProjectsController');
    Route::resource('project-notes', 'Admin\\ProjectNotesController');
    Route::DELETE('/delete-all-project-notes-for-particular-project/{id}', 'Admin\\ProjectNotesController@deleteAllNotesForParticularProject');

    Route::POST('/delete-certificate', 'Admin\EmployeesController@deleteCertificate');
    Route::resource('leave-managements', 'Admin\\LeaveManagementsController');


    Route::get('/employees', 'Admin\EmployeesController@index');
    Route::get('/employees/create', 'Admin\EmployeesController@create');
    Route::POST('/employees', 'Admin\EmployeesController@store');
    Route::get('/employees/{id}/edit', 'Admin\EmployeesController@edit');
    Route::PATCH('/employees/{id}', 'Admin\EmployeesController@update');
    Route::DELETE('/employees/{id}', 'Admin\EmployeesController@destroy');
    Route::get('/employees/{id}', 'Admin\EmployeesController@show');



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


    Route::resource('reviews', 'Admin\\ReviewsController');

    Route::get('/tasks', 'Admin\TasksController@index');
    Route::get('/tasks/create', 'Admin\TasksController@create');
    Route::POST('/tasks', 'Admin\TasksController@store');
    Route::get('/tasks/{unique_key}/edit', 'Admin\TasksController@edit');
    Route::PATCH('/tasks/{unique_key}', 'Admin\TasksController@update');
    Route::DELETE('/tasks/{id}', 'Admin\TasksController@destroy');
    Route::get('/tasks/{unique_key}', 'Admin\TasksController@show');
    Route::get('/pending-feedback-tasks', 'Admin\TasksController@pendingFeedbackTasks');
    Route::get('/completed-tasks', 'Admin\TasksController@completedTask');
    Route::PATCH('/task-feedback', 'Admin\TasksController@taskFeedback');
    Route::get('/reassign-task/{unique_key}', 'Admin\TasksController@reassignTask');
    Route::get('/my-assigned-tasks', 'Admin\TasksController@myAssignedTasks');
    Route::get('/my-in-progress-tasks', 'Admin\TasksController@myInprogressTasks');
    Route::get('/my-completed-tasks', 'Admin\TasksController@myCompletedTasks');
    Route::PATCH('/tasks/{unique_key}/submit', 'Admin\TasksController@taskSubmit');

    Route::resource('salary-expenses', 'Admin\\SalaryExpensesController');
    Route::get('/employee-view-salary-expenses', 'Admin\SalaryExpensesController@employeeViewSalaryExpense');
    Route::get('/employee-view-salary-expenses-show-details/{id}', 'Admin\SalaryExpensesController@employeeViewSalaryExpensesShowDetails');

    Route::resource('miscellaneous-expenses', 'Admin\\MiscellaneousExpensesController');

    Route::get('/credits', 'Admin\CreditsController@index');
    Route::get('/credits/create', 'Admin\CreditsController@create');
    Route::POST('/credits', 'Admin\CreditsController@store');
    Route::DELETE('/credits/{id}', 'Admin\CreditsController@destroy');

});





