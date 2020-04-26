<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use Carbon\Carbon;
use App\Employee;
use App\SalaryExpense;
use Illuminate\Http\Request;
use DB;

class SalaryExpensesController extends Controller
{
    public function index(Request $request)
    {
        $salaryexpenses = SalaryExpense::latest()->get();
        return view('admin.salary-expenses.index', compact('salaryexpenses'));
    }

    public function salaryViewByMonth()
    {
        $salaryExpenses = DB::table("salary_expenses")
                    ->select("date" ,DB::raw("(COUNT(*)) as count"),DB::raw("(SUM(amount)) as sum"))
                    ->orderBy('date')
                    ->groupBy(DB::raw("MONTH(date)"))
                    ->get();
        return view('admin.salary-expenses.view-by-month', compact('salaryExpenses'));
    }

    public function salaryViewByMonthDetails($date)
    {
        $salaryExpenses = DB::table('salary_expenses')
                    ->join('employees', 'employees.id', '=', 'salary_expenses.emp_id')
                    ->select('salary_expenses.*', 'employees.full_name as name')
                    ->whereMonth('date', Carbon::parse($date)->format('m'))
                    ->whereYear('date', Carbon::parse($date)->format('Y'))
                    ->get();
        $totalAmount = DB::table("salary_expenses")
                    ->select(DB::raw("(SUM(amount)) as sum"))
                    ->whereMonth('date', Carbon::parse($date)->format('m'))
                    ->first();
        return view('admin.salary-expenses.month-view-details', compact('salaryExpenses', 'totalAmount'));
    }

    public function create()
    {
        $employees = Employee::all();
        $salaryExpense = new SalaryExpense();
        return view('admin.salary-expenses.create', compact('employees', 'salaryExpense'));
    }

    public function store(Request $request)
    {
        $salaryExpense         = new SalaryExpense();
        $salaryExpense->emp_id = $request->emp_id;
        $salaryExpense->amount = $request->amount;
        $salaryExpense->date   = Carbon::parse($request->date)->format('Y/m/d');
        $salaryExpense->save();
        return redirect('salary-expenses')->with('flashMessage', 'Salary Expense added!');
    }

    public function show($id)
    {
        $salaryexpense = SalaryExpense::findOrFail($id);
        return view('admin.salary-expenses.show', compact('salaryexpense'));
    }

    public function edit($id)
    {
        $employees     = Employee::all();
        $salaryExpense = SalaryExpense::findOrFail($id);
        return view('admin.salary-expenses.edit', compact('employees', 'salaryExpense'));
    }

    public function update(Request $request, $id)
    {
        $salaryExpense         = SalaryExpense::findOrFail($id);
        $requestData           = array();
        $requestData['emp_id'] = $request->emp_id;
        $requestData['amount'] = $request->amount;
        if($request->date != null){
            $requestData['date']    = Carbon::parse($request->date)->format('Y/m/d');
        }
        $salaryExpense->update($requestData);
        return redirect('salary-expenses')->with('flashMessage', 'Salary Expense updated!');
    }

    public function destroy($id)
    {
        SalaryExpense::destroy($id);
        return redirect('salary-expenses')->with('flashMessage', 'Salary Expense deleted!');
    }

    public function employeeViewSalaryExpense()
    {
        $employees = Employee::all();
        return view('admin.salary-expenses.employee-view', compact('employees'));
    }

    public function employeeViewSalaryExpensesShowDetails($id)
    {
        $employee = Employee::where('id', $id)->first();
        return view('admin.salary-expenses.employee-view-show-details', compact('employee'));
    }
}
