<?php
namespace App\Http\Traits;
use Carbon\Carbon;
use DB;

trait DbQueryTrait {
    public function pendingLeaves(){
        $value = DB::table('leave_managements')
            ->where('status', 1)
            ->count();
        return $value;
    }

    public function salaryExpenses(){
        $value = DB::table("salary_expenses")
            ->whereRaw('MONTH(date) = ?',[Carbon::now()->format('m')])
            ->select(DB::raw("SUM(salary_expenses.amount) as totalSalaryExpense"))
            ->first();
        return $value;
    }

    public function miscellaneousExpenses(){
        $value = DB::table("miscellaneous_expenses")
            ->whereRaw('MONTH(date) = ?',[Carbon::now()->format('m')])
            ->select(DB::raw("SUM(miscellaneous_expenses.amount) as totalMiscellaneousExpense"))
            ->first();
        return $value;
    }

    public function totalEarning(){
        $value = DB::table("credits")
            ->whereRaw('MONTH(date) = ?',[Carbon::now()->format('m')])
            ->select(DB::raw("SUM(credits.amount) as totalEarning"))
            ->first();
        return $value;
    }

}



?>
