<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\JobStatus;
use Illuminate\Http\Request;

class JobStatusesController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $jobstatuses = JobStatus::where('name', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $jobstatuses = JobStatus::latest()->paginate($perPage);
        }

        return view('admin.job-statuses.index', compact('jobstatuses'));
    }

    public function create()
    {
        return view('admin.job-statuses.create');
    }

    public function store(Request $request)
    {
        
        $requestData = $request->all();
        
        JobStatus::create($requestData);

        return redirect('job-statuses')->with('flashMessage', 'JobStatus added!');
    }

    public function show($id)
    {
        $jobstatus = JobStatus::findOrFail($id);

        return view('admin.job-statuses.show', compact('jobstatus'));
    }

    public function edit($id)
    {
        $jobstatus = JobStatus::findOrFail($id);

        return view('admin.job-statuses.edit', compact('jobstatus'));
    }

    public function update(Request $request, $id)
    {
        
        $requestData = $request->all();
        
        $jobstatus = JobStatus::findOrFail($id);
        $jobstatus->update($requestData);

        return redirect('job-statuses')->with('flashMessage', 'JobStatus updated!');
    }

    public function destroy($id)
    {
        JobStatus::destroy($id);

        return redirect('job-statuses')->with('flashMessage', 'JobStatus deleted!');
    }
}
