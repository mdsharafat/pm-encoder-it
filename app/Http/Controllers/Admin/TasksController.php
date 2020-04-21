<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Employee;
use App\Project;
use App\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use DB;

class TasksController extends Controller
{
    public function index(Request $request)
    {
        $request->session()->put('currentTaskPageUrl', '/tasks');
        $tasks = Task::latest()->whereIn('status', [1,2,3])->get();
        return view('admin.tasks.index', compact('tasks'));
    }

    public function pendingFeedbackTasks(Request $request)
    {
        $request->session()->put('currentTaskPageUrl', '/pending-feedback-tasks');
        $tasks = Task::latest()->where('status', 4)->get();
        return view('admin.tasks.pending-feedback-tasks', compact('tasks'));
    }

    public function myAssignedTasks()
    {
        $tasks = Task::latest()->where('assigned_to', Auth::user()->employee->id)->whereIn('status', [1,2])->get();
        return view('admin.tasks.my-assigned-tasks', compact('tasks'));
    }

    public function myInprogressTasks()
    {
        $tasks = Task::latest()->where('assigned_to', Auth::user()->employee->id)->where('status', 3)->get();
        return view('admin.tasks.my-in-progress-tasks', compact('tasks'));
    }

    public function myCompletedTasks()
    {
        $tasks = Task::latest()->where('assigned_to', Auth::user()->employee->id)->whereIn('status', [4,5])->get();
        return view('admin.tasks.my-completed-tasks', compact('tasks'));
    }

    public function taskInProgress(Request $request, $unique_key)
    {
        DB::table('tasks')
            ->where('unique_key', $unique_key)
            ->update(['status' => 3]);
            return redirect()->back()->with('flashMessage', 'Task in progress');
    }

    public function taskSubmit(Request $request, $unique_key)
    {
        DB::table('tasks')
            ->where('unique_key', $unique_key)
            ->update(['status' => 4]);
            return redirect()->back()->with('flashMessage', 'Task Submitted');
    }

    public function completedTask(Request $request)
    {
        $request->session()->put('currentTaskPageUrl', '/completed-tasks');

        $tasks = Task::latest()->where('status', 5)->get();
        return view('admin.tasks.completed-tasks', compact('tasks'));
    }

    public function taskFeedback(Request $request)
    {
        $task = Task::where('unique_key', $request->unique_key)->first();
        if((float)($request->received_point) > $task->total_point){
            return redirect()->back()->with('flashMessage', 'Feedback point cannot be greater than total point.');
        }else{
            DB::table('tasks')
              ->where('unique_key', $request->unique_key)
              ->update(['received_point' => $request->received_point, 'status' => 5]);
            return redirect()->back()->with('flashMessage', 'Feedback given successfully');
        }
    }

    public function reassignTask($unique_key)
    {
        DB::table('tasks')
            ->where('unique_key', $unique_key)
            ->update(['status' => 2]);
        return redirect()->back()->with('flashMessage', 'Task Reassigned');
    }

    public function create()
    {
        $employees  = Employee::all();
        $projects   = Project::all();
        $task       = new Task();
        return view('admin.tasks.create', compact('employees', 'projects', 'task'));
    }

    public function store(Request $request)
    {
        $task              = new Task();
        $task->assigned_to = $request->assigned_to;
        $task->assigned_by = Auth::user()->id;
        $task->project_id  = $request->project_id;
        $task->unique_key  = $this->generateUniqueKey();
        $task->status      = 1;
        $task->deadline    = Carbon::parse($request->deadline)->format('Y/m/d H:i');
        $task->total_point = $request->total_point;
        $task->task        = $request->task;
        $task->save();
        return redirect('tasks')->with('flashMessage', 'Task added!');
    }

    protected function generateUniqueKey()
    {
        $unique_key = '';
        $is_unique  = 0;
        do {
            $unique_key = Str::random(40);
            $is_found   = Task::where('unique_key',$unique_key)->first();
            if($is_found == null){
                $is_unique = 1;
                break;
            }else{
                $is_unique = 0;
            }
        } while ($is_unique);

        return $unique_key;
    }

    public function show($unique_key)
    {
        $task = Task::where('unique_key', $unique_key)->first();
        return view('admin.tasks.show', compact('task'));
    }

    public function edit(Request $request, $id)
    {
        $employees = Employee::all();
        $projects  = Project::all();
        $task      = Task::findOrFail($id);
        return view('admin.tasks.edit', compact('employees', 'projects', 'task'));
    }

    public function update(Request $request, $id)
    {
        $task        = Task::findOrFail($id);
        $requestData = array();
        $requestData['assigned_to'] = $request->assigned_to;
        $requestData['assigned_by'] = Auth::user()->id;
        $requestData['project_id']  = $request->project_id;
        if($request->deadline != null){
            $requestData['deadline']    = Carbon::parse($request->deadline)->format('Y/m/d H:i');
        }
        $requestData['total_point'] = $request->total_point;
        $requestData['task']        = $request->task;
        $task->update($requestData);
        if($request->session()->get('currentTaskPageUrl')){
            return redirect($request->session()->get('currentTaskPageUrl'))->with('flashMessage', 'Task updated!');
        }else{
            return redirect('tasks')->with('flashMessage', 'Task updated!');
        }
    }

    public function destroy($id)
    {
        Task::destroy($id);

        return redirect('tasks')->with('flashMessage', 'Task deleted!');
    }
}
