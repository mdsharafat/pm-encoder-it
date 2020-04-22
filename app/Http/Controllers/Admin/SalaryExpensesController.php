<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use Carbon\Carbon;
use App\Employee;
use App\SalaryExpense;
use Illuminate\Http\Request;

class SalaryExpensesController extends Controller
{
    public function index(Request $request)
    {
        $salaryexpenses = SalaryExpense::latest()->get();
        return view('admin.salary-expenses.index', compact('salaryexpenses'));
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
}
