<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Contribution;
use App\Project;
use App\Employee;
use Illuminate\Http\Request;
use DB;

class ContributionsController extends Controller
{

    public function index(Request $request)
    {
        $contributions = Contribution::selectRaw('count(emp_id) AS totalEmployee, project_id, unique_key')->groupBy('project_id')->get();
        return view('admin.contributions.index', compact('contributions'));
    }

    public function create()
    {
        $contribution   = new Contribution();
        $projects       = Project::all();
        $employees      = Employee::all();
        return view('admin.contributions.create', compact('projects', 'contribution', 'employees'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'project_id'   => 'required',
            'emp_id'       => 'required',
            'contribution' => 'required'
        ], [
                'project_idrequired' => 'You have to choose a project!',
                'emp_id.required' => 'You have to choose an employee!',
                'contribution.required' => 'Contribution cannot empty!'
            ]);
        $contribution               = new Contribution();
        $contribution->project_id   = $request->project_id;
        $contribution->emp_id       = $request->emp_id;
        $contribution->unique_key   = $contribution->has_unique_key($request->project_id);
        $contribution->comment      = $request->comment;
        $contribution->contribution = $request->contribution;
        $remaining_contribution     = Contribution::selectRaw('(100 - SUM(contribution)) AS remaining')->where('project_id', $request->project_id)->first();
        if($request->contribution > $remaining_contribution->remaining && $remaining_contribution->remaining != null){
            return redirect()->back()->withErrors(['contribution' => ['Contribution cannot be greater than remaining']]);
        }
        $contribution->save();

        return redirect('contributions')->with('flashMessage', 'Contribution added!');
    }

    public function show($id)
    {
        $contribution = Contribution::findOrFail($id);
        return view('admin.contributions.show', compact('contribution'));
    }

    public function edit($unique_key)
    {
        $projects = Project::all();
        $employees = Employee::all();
        return view('admin.contributions.edit', compact('contribution', 'projects', 'employees'));
    }

    public function update(Request $request)
    {
        $unique_key   = $request->unique_key;
        $project_id   = $request->project_id;
        $emp_id       = $request->emp_id;
        $contribution = $request->contribution;
        $remaining    = Contribution::selectRaw('(100 - SUM(contribution)) AS remaining')->where('project_id', $project_id)->where('unique_key', $unique_key)->first();
        $projectWiseEmployeeContribution = Contribution::projectWiseEmployeeContribution($project_id, $emp_id);

        if($request->contribution <= ($remaining->remaining + $projectWiseEmployeeContribution['emp_contribution']->contribution)){
            DB::table('contributions')
                ->where("contributions.project_id", '=',  $project_id)
                ->where("contributions.emp_id", '=',  $emp_id)
                ->where("contributions.unique_key", '=',  $unique_key)
                ->update(['contributions.contribution'=> $contribution]);
            return response()->json([
                'msg' => 'success'
            ]);
        }else {
            return response()->json([
                'msg' => 'error'
            ]);
        }
    }

    public function destroy($id) {
        Contribution::destroy($id);
        return redirect('contributions')->with('flashMessage', 'Contribution deleted!');
    }

    public function projectWiseContribution($unique_key) {
        $projectWiseContribution = Contribution::where('unique_key', $unique_key)->get();
        return view('admin.contributions.project-wise-contribution', compact('projectWiseContribution'));
    }

    public function checkProjectTotalContributionStatus(Request $request) {
        $remaining = Contribution::selectRaw('(100 - SUM(contribution)) AS remaining')->where('project_id', $request->id)->first();
        $employee_array = [];
        $employee_in_contributions_table = Contribution::selectRaw('emp_id')->where('project_id',$request->id)->get();
        if($employee_in_contributions_table != null) {
            foreach ($employee_in_contributions_table as $item) {
                array_push($employee_array, $item->emp_id);
            }
        }
        $employees = Employee::whereNotIn('id', $employee_array)->get();

        return response()->json([
            'msg' => 'success',
            'remaining' => $remaining,
            'employees' => $employees
        ]);
    }

    public function checkEmployeeContributionStatus(Request $request) {
        return response()->json([
            "msg" => 'success',
            "contribution" => Contribution::projectWiseEmployeeContribution($request->project, $request->employee)
        ]);
    }

    public function employeeWiseDeleteContribution(Request $request) {
        DB::table('contributions')->where('project_id', '=', $request->project)->where('emp_id', '=', $request->employee)->delete();
        return redirect()->back()->with('flashMessage', 'Contribution deleted successfully');
    }

    public function projectWiseDeleteContribution(Request $request) {
        DB::table('contributions')->where('project_id', '=', $request->project)->where('unique_key', '=', $request->unique_key)->delete();
        return redirect()->back()->with('flashMessage', 'Contribution deleted successfully');
    }
}
