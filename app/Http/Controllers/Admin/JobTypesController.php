<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\JobType;
use Illuminate\Http\Request;

class JobTypesController extends Controller
{
    public function index(Request $request)
    {
        $jobTypes = JobType::latest()->get();
        return view('admin.job-types.index', compact('jobTypes'));
    }

    public function create()
    {
        return view('admin.job-types.create');
    }

    public function store(Request $request)
    {
        
        $requestData = $request->all();
        
        JobType::create($requestData);

        return redirect('job-types')->with('flashMessage', 'Job Type added!');
    }

    public function show($id)
    {
        $jobType = JobType::findOrFail($id);

        return view('admin.job-types.show', compact('jobType'));
    }

    public function edit($id)
    {
        $jobType = JobType::findOrFail($id);

        return view('admin.job-types.edit', compact('jobType'));
    }

    public function update(Request $request, $id)
    {
        
        $requestData = $request->all();
        
        $jobType = JobType::findOrFail($id);
        $jobType->update($requestData);

        return redirect('job-types')->with('flashMessage', 'Job Type updated!');
    }

    public function destroy($id)
    {
        JobType::destroy($id);

        return redirect('job-types')->with('flashMessage', 'Job Type deleted!');
    }
}
