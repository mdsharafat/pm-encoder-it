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
    Route::get('/employee-dashboard', 'Admin\EmployeesController@employeeDashboard');

    Route::group(['middleware' => ['role:Admin']], function () {

        //users
        Route::get('/users/create', 'Admin\UserController@create');
        Route::POST('/users', 'Admin\UserController@store');
        Route::get('/users', 'Admin\UserController@index');
        Route::get('/users/{id}/edit', 'Admin\UserController@edit');
        Route::PATCH('/users/{id}', 'Admin\UserController@update');
        Route::DELETE('/users/{id}', 'Admin\UserController@destroy');
        Route::get('/user-settings', 'Admin\UserController@userSettings');
        Route::POST('/change-password', 'Admin\UserController@changePassword');
        Route::PATCH('/change-user-image', 'Admin\UserController@changeUserImage');
        Route::get('/permission-management/{id}', 'Admin\PermissionManagementController@edit');
        Route::POST('/permission-management', 'Admin\PermissionManagementController@updatePermission');

        //projects
        Route::get('/projects/create', 'Admin\ProjectsController@create');
        Route::POST('/projects', 'Admin\ProjectsController@store');
        Route::get('/projects/{id}/edit', 'Admin\ProjectsController@edit');
        Route::PATCH('/projects/{id}', 'Admin\ProjectsController@update');
        Route::DELETE('/projects/{id}', 'Admin\ProjectsController@destroy');

        //credits
        Route::get('/credits', 'Admin\CreditsController@index');
        Route::get('/credits/create', 'Admin\CreditsController@create');
        Route::POST('/credits', 'Admin\CreditsController@store');
        Route::get('/credits/{id}/edit', 'Admin\CreditsController@edit');
        Route::PATCH('/credits/{id}', 'Admin\CreditsController@update');
        Route::DELETE('/credits/{id}', 'Admin\CreditsController@destroy');
        Route::get('/credits-view-by-month', 'Admin\CreditsController@creditesViewByMonth');
        Route::get('/credits-view-by-month-details/{date}', 'Admin\CreditsController@creditesViewByMonthDetails');

        // salary expense
        Route::get('/salary-expenses', 'Admin\SalaryExpensesController@index');
        Route::get('/salary-expenses/create', 'Admin\SalaryExpensesController@create');
        Route::POST('/salary-expenses', 'Admin\SalaryExpensesController@store');
        Route::get('/salary-expenses/{id}/edit', 'Admin\SalaryExpensesController@edit');
        Route::PATCH('/salary-expenses/{id}', 'Admin\SalaryExpensesController@update');
        Route::DELETE('/salary-expenses/{id}', 'Admin\SalaryExpensesController@destroy');
        Route::get('/salary-expenses-view-by-month', 'Admin\SalaryExpensesController@salaryViewByMonth');
        Route::get('/salary-expenses-view-by-month-details/{date}', 'Admin\SalaryExpensesController@salaryViewByMonthDetails');
        Route::get('/employee-view-salary-expenses', 'Admin\SalaryExpensesController@employeeViewSalaryExpense');
        Route::get('/employee-view-salary-expenses-show-details/{id}', 'Admin\SalaryExpensesController@employeeViewSalaryExpensesShowDetails');

        // miscellaneous
        Route::get('/miscellaneous-expenses', 'Admin\MiscellaneousExpensesController@index');
        Route::get('/miscellaneous-expenses/create', 'Admin\MiscellaneousExpensesController@create');
        Route::POST('/miscellaneous-expenses', 'Admin\MiscellaneousExpensesController@store');
        Route::get('/miscellaneous-expenses/{id}/edit', 'Admin\MiscellaneousExpensesController@edit');
        Route::PATCH('/miscellaneous-expenses/{id}', 'Admin\MiscellaneousExpensesController@update');
        Route::DELETE('/miscellaneous-expenses/{id}', 'Admin\MiscellaneousExpensesController@destroy');
        Route::get('/miscellaneous-expenses-view-by-month', 'Admin\MiscellaneousExpensesController@miscellaneousViewByMonth');
        Route::get('/miscellaneous-expenses-view-by-month-details/{date}', 'Admin\MiscellaneousExpensesController@miscellaneousViewByMonthDetails');

        //platforms
        Route::get('/platforms', 'Admin\PlatformsController@index');
        Route::get('/platforms/create', 'Admin\PlatformsController@create');
        Route::POST('/platforms', 'Admin\PlatformsController@store');
        Route::get('/platforms/{id}/edit', 'Admin\PlatformsController@edit');
        Route::PATCH('/platforms/{id}', 'Admin\PlatformsController@update');
        Route::DELETE('/platforms/{id}', 'Admin\PlatformsController@destroy');

        //clients
        Route::resource('clients', 'Admin\\ClientsController');

        //project notes
        Route::resource('project-notes', 'Admin\\ProjectNotesController');
        Route::DELETE('/delete-all-project-notes-for-particular-project/{id}', 'Admin\\ProjectNotesController@deleteAllNotesForParticularProject');

    });

    ///departments
    Route::get('/departments', 'Admin\DepartmentsController@index')->middleware('permission:view-department');
    Route::get('/departments/create', 'Admin\DepartmentsController@create')->middleware('permission:add-department');
    Route::POST('/departments', 'Admin\DepartmentsController@store')->middleware('permission:add-department');
    Route::get('/departments/{id}/edit', 'Admin\DepartmentsController@edit')->middleware('permission:edit-department');
    Route::PATCH('/departments/{id}', 'Admin\DepartmentsController@update')->middleware('permission:edit-department');
    Route::DELETE('/departments/{id}', 'Admin\DepartmentsController@destroy')->middleware('permission:delete-department');

    //designations
    Route::get('/designations', 'Admin\DesignationsController@index')->middleware('permission:view-designation');
    Route::get('/designations/create', 'Admin\DesignationsController@create')->middleware('permission:add-designation');
    Route::POST('/designations', 'Admin\DesignationsController@store')->middleware('permission:add-designation');
    Route::get('/designations/{id}/edit', 'Admin\DesignationsController@edit')->middleware('permission:edit-designation');
    Route::PATCH('/designations/{id}', 'Admin\DesignationsController@update')->middleware('permission:edit-designation');
    Route::DELETE('/designations/{id}', 'Admin\DesignationsController@destroy')->middleware('permission:delete-designation');


    Route::get('/projects', 'Admin\ProjectsController@index');
    Route::get('/projects/{id}', 'Admin\ProjectsController@show');

    Route::get('/employees', 'Admin\EmployeesController@index')->middleware('permission:view-employee-list');
    Route::get('/employees/create', 'Admin\EmployeesController@create')->middleware('permission:add-employee');
    Route::POST('/employees', 'Admin\EmployeesController@store')->middleware('permission:add-employee');
    Route::get('/employees/{id}/edit', 'Admin\EmployeesController@edit')->middleware('permission:edit-employee');
    Route::PATCH('/employees/{id}', 'Admin\EmployeesController@update')->middleware('permission:edit-employee');
    Route::DELETE('/employees/{id}', 'Admin\EmployeesController@destroy')->middleware('permission:delete-employee');
    Route::get('/employees/{id}', 'Admin\EmployeesController@show')->middleware('permission:view-employee-details');
    Route::POST('/delete-certificate', 'Admin\EmployeesController@deleteCertificate')->middleware('permission:edit-employee');

    //leave management
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
    // reviews
    Route::get('/reviews', 'Admin\ReviewsController@index')->middleware('permission:view-review');
    Route::get('/reviews/create', 'Admin\ReviewsController@create')->middleware('permission:add-review');
    Route::POST('/reviews', 'Admin\ReviewsController@store')->middleware('permission:add-review');
    Route::get('/reviews/{id}/edit', 'Admin\ReviewsController@edit')->middleware('permission:edit-review');
    Route::PATCH('/reviews/{id}', 'Admin\ReviewsController@update')->middleware('permission:edit-review');
    Route::DELETE('/reviews/{id}', 'Admin\ReviewsController@destroy')->middleware('permission:delete-review');
    Route::get('/employee-view-reviews', 'Admin\ReviewsController@viewByEmployee')->middleware('permission:view-review');
    Route::get('/all-review-unique-employee/{id}', 'Admin\ReviewsController@allReviewUniqueEmployee')->middleware('permission:view-review');

    Route::get('/tasks', 'Admin\TasksController@index')->middleware('permission:view-task');
    Route::get('/tasks/create', 'Admin\TasksController@create')->middleware('permission:add-task');
    Route::POST('/tasks', 'Admin\TasksController@store')->middleware('permission:add-task');
    Route::get('/tasks/{unique_key}/edit', 'Admin\TasksController@edit')->middleware('permission:update-task');
    Route::PATCH('/tasks/{unique_key}', 'Admin\TasksController@update')->middleware('permission:update-task');
    Route::DELETE('/tasks/{id}', 'Admin\TasksController@destroy')->middleware('permission:delete-task');
    Route::get('/tasks/{unique_key}', 'Admin\TasksController@show');
    Route::get('/pending-feedback-tasks', 'Admin\TasksController@pendingFeedbackTasks')->middleware('permission:view-task');
    Route::get('/completed-tasks', 'Admin\TasksController@completedTask')->middleware('permission:view-task');
    Route::PATCH('/task-feedback', 'Admin\TasksController@taskFeedback')->middleware('permission:feedback-task');
    Route::get('/reassign-task/{unique_key}', 'Admin\TasksController@reassignTask')->middleware('permission:feedback-task');
    Route::get('/my-assigned-tasks', 'Admin\TasksController@myAssignedTasks');
    Route::get('/my-in-progress-tasks', 'Admin\TasksController@myInprogressTasks');
    Route::get('/my-completed-tasks', 'Admin\TasksController@myCompletedTasks');
    Route::PATCH('/tasks/{unique_key}/submit', 'Admin\TasksController@taskSubmit');
    Route::PATCH('/tasks/{unique_key}/inprogress', 'Admin\TasksController@taskInProgress');

});





