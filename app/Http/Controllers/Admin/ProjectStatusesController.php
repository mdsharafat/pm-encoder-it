<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\ProjectStatus;
use Illuminate\Http\Request;

class ProjectStatusesController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $projectstatuses = ProjectStatus::where('name', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $projectstatuses = ProjectStatus::latest()->paginate($perPage);
        }

        return view('admin.project-statuses.index', compact('projectstatuses'));
    }

    public function create()
    {
        return view('admin.project-statuses.create');
    }

    public function store(Request $request)
    {
        
        $requestData = $request->all();
        
        ProjectStatus::create($requestData);

        return redirect('project-statuses')->with('flashMessage', 'ProjectStatus added!');
    }

    public function show($id)
    {
        $projectstatus = ProjectStatus::findOrFail($id);

        return view('admin.project-statuses.show', compact('projectstatus'));
    }

    public function edit($id)
    {
        $projectstatus = ProjectStatus::findOrFail($id);

        return view('admin.project-statuses.edit', compact('projectstatus'));
    }

    public function update(Request $request, $id)
    {
        
        $requestData = $request->all();
        
        $projectstatus = ProjectStatus::findOrFail($id);
        $projectstatus->update($requestData);

        return redirect('project-statuses')->with('flashMessage', 'ProjectStatus updated!');
    }

    public function destroy($id)
    {
        ProjectStatus::destroy($id);

        return redirect('project-statuses')->with('flashMessage', 'ProjectStatus deleted!');
    }
}
