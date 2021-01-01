<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Project;
use App\SalaryExpense;
use Carbon\Carbon;
use DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Traits;

class AdminController extends Controller
{
    use Traits\DbQueryTrait;

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
        $totalExpense            = 0.00;
        $totalEarning            = 0.00;


        $projects               = Project::where('status', 0)->get();
        $pendingLeaves          = $this->pendingLeaves();
        $salaryExpenses         = $this->salaryExpenses();
        $miscellaneousExpenses  = $this->miscellaneousExpenses();
        $totalEarningObject     = $this->totalEarning();
        $totalEarning           = number_format($totalEarningObject->totalEarning, 2);
        $totalExpense           = number_format($salaryExpenses->totalSalaryExpense + $miscellaneousExpenses->totalMiscellaneousExpense, 2, '.', ',');

        return view('admin.dashboard', compact('projects', 'pendingLeaves', 'totalExpense', 'totalEarning'));
    }
}
