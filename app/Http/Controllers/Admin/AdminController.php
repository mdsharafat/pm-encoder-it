<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Project;
use App\Task;
use App\SalaryExpense;
use Carbon\Carbon;
use DB;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (!Auth::user()->hasRole('Admin')) {
                return redirect('/employee-dashboard');
            }
            return $next($request);
        });
    }

    public function index()
    {
        $completedStatus         = 0.00;
        $pendingStatus           = 0.00;
        $percentageTaskCompleted = 0.00;
        $totalExpense            = 0.00;
        $totalEarning            = 0.00;

        $projects = Project::where('status', 0)->get();
        $tasks    = DB::table('tasks')
                    ->join('projects', 'projects.id' , '=', 'tasks.project_id')
                    ->where('projects.status', '=', 0)
                    ->select('tasks.status', DB::raw('count(*) as count'))
                    ->groupBy('tasks.status')
                    ->get();

        $pendingLeaves = DB::table('leave_managements')
                        ->where('status', 1)
                        ->count();

        $salaryExpenses = DB::table("salary_expenses")
                        ->whereRaw('MONTH(date) = ?',[Carbon::now()->format('m')])
                        ->select(DB::raw("SUM(salary_expenses.amount) as totalSalaryExpense"))
                        ->first();

        $miscellaneousExpenses = DB::table("miscellaneous_expenses")
                                ->whereRaw('MONTH(date) = ?',[Carbon::now()->format('m')])
                                ->select(DB::raw("SUM(miscellaneous_expenses.amount) as totalMiscellaneousExpense"))
                                ->first();

        $totalEarningObject = DB::table("credits")
                        ->whereRaw('MONTH(date) = ?',[Carbon::now()->format('m')])
                        ->select(DB::raw("SUM(credits.amount) as totalEarning"))
                        ->first();
        $totalEarning = number_format($totalEarningObject->totalEarning, 2);

        $totalExpense = number_format($salaryExpenses->totalSalaryExpense + $miscellaneousExpenses->totalMiscellaneousExpense, 2, '.', ',');

        if($tasks->isNotEmpty()){
            foreach($tasks as $task){
                if($task->status != 5){
                    $pendingStatus = $pendingStatus + $task->count;
                }else{
                    $completedStatus = $completedStatus + $task->count;
                }
            }
            $percentageTaskCompleted = number_format(floor(($completedStatus * 100) / $pendingStatus), 0);
        }
        return view('admin.dashboard', compact('projects','percentageTaskCompleted', 'pendingLeaves', 'totalExpense', 'totalEarning'));
    }
}
