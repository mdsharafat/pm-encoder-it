<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\TaskStatus;
use Illuminate\Http\Request;

class TaskStatusesController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $taskstatuses = TaskStatus::where('name', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $taskstatuses = TaskStatus::latest()->paginate($perPage);
        }

        return view('admin.task-statuses.index', compact('taskstatuses'));
    }

    public function create()
    {
        return view('admin.task-statuses.create');
    }

    public function store(Request $request)
    {
        
        $requestData = $request->all();
        
        TaskStatus::create($requestData);

        return redirect('task-statuses')->with('flashMessage', 'TaskStatus added!');
    }

    public function show($id)
    {
        $taskstatus = TaskStatus::findOrFail($id);

        return view('admin.task-statuses.show', compact('taskstatus'));
    }

    public function edit($id)
    {
        $taskstatus = TaskStatus::findOrFail($id);

        return view('admin.task-statuses.edit', compact('taskstatus'));
    }

    public function update(Request $request, $id)
    {
        
        $requestData = $request->all();
        
        $taskstatus = TaskStatus::findOrFail($id);
        $taskstatus->update($requestData);

        return redirect('task-statuses')->with('flashMessage', 'TaskStatus updated!');
    }

    public function destroy($id)
    {
        TaskStatus::destroy($id);

        return redirect('task-statuses')->with('flashMessage', 'TaskStatus deleted!');
    }
}
