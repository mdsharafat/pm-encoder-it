<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Http\Traits;
use App\Client;
use Carbon\Carbon;
use App\Project;
use App\Employee;
use Illuminate\Http\Request;
use DB;

class ProjectsController extends Controller
{
    use Traits\UniqueKeyTrait;

    public function index(Request $request) {
        $projects = Project::latest()->get();
        return view('admin.projects.index', compact('projects'));
    }

    public function employeeProjects() {
        $projects = Project::latest()->get();
        return view('admin.projects.employee-projects', compact('projects'));
    }

    public function create() {
        $clients = Client::all();
        $project = new Project();
        return view('admin.projects.create', compact('clients', 'project'));
    }

    public function store(Request $request) {
        $request->validate([
            'title' => 'required',
            'client_id' => 'required',
            'budget' => 'required',
            'deadline' => 'required'
        ]);

        $client                        = Client::where('id', $request->client_id)->first();
        $project                       = new Project();
        $project->unique_key           = $this->generateUniqueKey(get_class($project));
        $project->title                = $request->title;
        $project->client_id            = $request->client_id;
        $project->platform_id          = $client->platform->id;
        $project->budget               = $request->budget;
        $project->starts_from          = Carbon::parse($request->starts_from)->format('Y/m/d');
        $project->deadline             = Carbon::parse($request->deadline)->format('Y/m/d');
        $project->desc                 = $request->desc;
        $project->git_repo             = $request->git_repo;
        $project->trello_link          = $request->trello_link;
        $project->gd_link              = $request->gd_link;
        $project->demo_web_link        = $request->demo_web_link;
        $project->live_project_link    = $request->live_project_link;
        $project->feedback_from_client = $request->feedback_from_client;
        $project->feedback_to_client   = $request->feedback_to_client;
        $project->save();
        return redirect('projects')->with('flashMessage', 'Project added!');
    }

    public function show($unique_key) {
        $project = Project::where('unique_key', $unique_key)->first();
        return view('admin.projects.show', compact('project'));
    }

    public function edit($unique_key) {
        $clients = Client::all();
        $project = Project::where('unique_key', $unique_key)->first();
        return view('admin.projects.edit', compact('clients', 'project'));
    }

    public function update(Request $request, $id) {
        $client      = Client::where('id', $request->client_id)->first();
        $project     = Project::findOrFail($id);
        $requestData = array();

        $requestData['title']                = $request->title;
        $requestData['client_id']            = $request->client_id;
        $requestData['platform_id']          = $client->platform_id;
        $requestData['budget']               = $request->budget;
        $requestData['starts_from']          = Carbon::parse($request->starts_from)->format('Y/m/d');
        $requestData['deadline']             = Carbon::parse($request->deadline)->format('Y/m/d');
        $requestData['desc']                 = $request->desc;
        $requestData['git_repo']             = $request->git_repo;
        $requestData['trello_link']          = $request->trello_link;
        $requestData['gd_link']              = $request->gd_link;
        $requestData['demo_web_link']        = $request->demo_web_link;
        $requestData['live_project_link']    = $request->live_project_link;
        $requestData['feedback_from_client'] = $request->feedback_from_client;
        $requestData['feedback_to_client']   = $request->feedback_to_client;
        $project->update($requestData);

        return redirect('projects')->with('flashMessage', 'Project updated!');
    }

    public function destroy($id) {
        Project::destroy($id);
        return redirect('projects')->with('flashMessage', 'Project deleted!');
    }

    public function involvementCreate() {
        $projects  = Project::all();
        $employees = Employee::all();
        return view('admin.projects.involvement', compact('projects', 'employees'));
    }

    public function availableEmployeeProject(Request $request) {
        $project                  = Project::where('unique_key', $request->id)->first();
        $involved_employees_array = [];
        foreach ($project->employees as $employee) {
            array_push($involved_employees_array, $employee->id);
        }
        $available_employees       = Employee::whereNotIn('id', $involved_employees_array)->get();
        return response()->json([
            'msg'                 => 'success',
            'available_employees' => $available_employees
        ]);
    }

    public function involvementStore(Request $request) {
        $project = Project::where('unique_key', $request->project_id)->first();
        DB::table('employee_project')->insert([
            'project_id' => $project->id,
            'emp_id'     => $request->emp_id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        return redirect()->back()->with('flashMessage', Employee::where('id', $request->emp_id)->first()->full_name.' added to '.$project->title);
    }
}
