<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\Department;
use Illuminate\Http\Request;

class DepartmentsController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $departments = Department::where('name', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $departments = Department::latest()->paginate($perPage);
        }

        return view('admin.departments.index', compact('departments'));
    }

    public function create()
    {
        return view('admin.departments.create');
    }

    public function store(Request $request)
    {
        
        $requestData = $request->all();
        
        Department::create($requestData);

        return redirect('departments')->with('flashMessage', 'Department added!');
    }

    public function show($id)
    {
        $department = Department::findOrFail($id);

        return view('admin.departments.show', compact('department'));
    }

    public function edit($id)
    {
        $department = Department::findOrFail($id);

        return view('admin.departments.edit', compact('department'));
    }

    public function update(Request $request, $id)
    {
        
        $requestData = $request->all();
        
        $department = Department::findOrFail($id);
        $department->update($requestData);

        return redirect('departments')->with('flashMessage', 'Department updated!');
    }

    public function destroy($id)
    {
        Department::destroy($id);

        return redirect('departments')->with('flashMessage', 'Department deleted!');
    }
}
