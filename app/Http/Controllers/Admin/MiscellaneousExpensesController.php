<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\MiscellaneousExpense;
use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;

class MiscellaneousExpensesController extends Controller
{
    public function index(Request $request)
    {
        $miscellaneousExpenses = MiscellaneousExpense::latest()->get();
        return view('admin.miscellaneous-expenses.index', compact('miscellaneousExpenses'));
    }

    public function miscellaneousViewByMonth()
    {
        $miscellaneous = DB::table("miscellaneous_expenses")
                    ->select("date" ,DB::raw("(COUNT(*)) as count"),DB::raw("(SUM(amount)) as sum"))
                    ->orderBy('date')
                    ->groupBy(DB::raw("MONTH(date)"))
                    ->get();
        return view('admin.miscellaneous-expenses.view-by-month', compact('miscellaneous'));
    }

    public function miscellaneousViewByMonthDetails($date)
    {
        $miscellaneous = DB::table('miscellaneous_expenses')
                    ->select('miscellaneous_expenses.*')
                    ->whereMonth('date', Carbon::parse($date)->format('m'))
                    ->whereYear('date', Carbon::parse($date)->format('Y'))
                    ->get();
        $totalAmount = DB::table("miscellaneous_expenses")
                    ->select(DB::raw("(SUM(amount)) as sum"))
                    ->whereMonth('date', Carbon::parse($date)->format('m'))
                    ->first();
        return view('admin.miscellaneous-expenses.month-view-details', compact('miscellaneous', 'totalAmount'));
    }

    public function create()
    {
        return view('admin.miscellaneous-expenses.create');
    }

    public function store(Request $request)
    {
        $miscellaneousExpense         = new MiscellaneousExpense();
        $miscellaneousExpense->name   = $request->name;
        $miscellaneousExpense->amount = $request->amount;
        $miscellaneousExpense->date   = Carbon::parse($request->date)->format('Y/m/d');
        $miscellaneousExpense->save();
        return redirect('miscellaneous-expenses')->with('flashMessage', 'Miscellaneous Expense added!');
    }

    public function show($id)
    {
        $miscellaneousExpenses = MiscellaneousExpense::findOrFail($id);

        return view('admin.miscellaneous-expenses.show', compact('miscellaneousExpenses'));
    }

    public function edit($id)
    {
        $miscellaneousExpenses = MiscellaneousExpense::findOrFail($id);

        return view('admin.miscellaneous-expenses.edit', compact('miscellaneousExpenses'));
    }

    public function update(Request $request, $id)
    {
        $miscellaneousExpenses = MiscellaneousExpense::findOrFail($id);
        $requestData           = array();
        $requestData['name']   = $request->name;
        $requestData['amount'] = $request->amount;
        if($request->date != null){
            $requestData['date'] = Carbon::parse($request->date)->format('Y/m/d');
        }
        $miscellaneousExpenses->update($requestData);

        return redirect('miscellaneous-expenses')->with('flashMessage', 'Miscellaneous Expense updated!');
    }

    public function destroy($id)
    {
        MiscellaneousExpense::destroy($id);

        return redirect('miscellaneous-expenses')->with('flashMessage', 'Miscellaneous Expense deleted!');
    }
}
