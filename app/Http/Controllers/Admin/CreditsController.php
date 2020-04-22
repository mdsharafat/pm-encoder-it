<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\Credit;
use App\Project;
use Illuminate\Http\Request;
use Carbon\Carbon;

class CreditsController extends Controller
{
    public function index(Request $request)
    {
        $credits = Credit::latest()->get();
        return view('admin.credits.index', compact('credits'));
    }

    public function create()
    {
        $credit   = new Credit();
        $projects = Project::all();
        return view('admin.credits.create', compact('credit', 'projects'));
    }

    public function store(Request $request)
    {
        $credit             = new Credit();
        $credit->project_id = $request->project_id;
        $credit->amount     = $request->amount;
        $credit->date       = Carbon::parse($request->date)->format('Y/m/d');
        $credit->save();
        return redirect('credits')->with('flashMessage', 'Credit added!');
    }

    public function show($id)
    {
        $credit = Credit::findOrFail($id);
        return view('admin.credits.show', compact('credit'));
    }

    public function edit($id)
    {
        $credit   = Credit::findOrFail($id);
        $projects = Project::all();
        return view('admin.credits.edit', compact('credit', 'projects'));
    }

    public function update(Request $request, $id)
    {
        $credit                    = Credit::findOrFail($id);
        $requestData               = array();
        $requestData['project_id'] = $request->project_id;
        $requestData['amount']     = $request->amount;
        if($request->date != null){
            $requestData['date']   = Carbon::parse($request->date)->format('Y/m/d');
        }
        $credit->update($requestData);
        return redirect('credits')->with('flashMessage', 'Credit updated!');
    }

    public function destroy($id)
    {
        Credit::destroy($id);

        return redirect('credits')->with('flashMessage', 'Credit deleted!');
    }
}
