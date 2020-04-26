<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\Designation;
use Illuminate\Http\Request;

class DesignationsController extends Controller
{
    public function index(Request $request)
    {
        $designations = Designation::latest()->get();
        return view('admin.designations.index', compact('designations'));
    }

    public function create()
    {
        return view('admin.designations.create');
    }

    public function store(Request $request)
    {
        $requestData = $request->all();
        Designation::create($requestData);
        return redirect('designations')->with('flashMessage', 'Designation added!');
    }

    public function edit($id)
    {
        $designation = Designation::findOrFail($id);
        return view('admin.designations.edit', compact('designation'));
    }

    public function update(Request $request, $id)
    {
        $requestData = $request->all();
        $designation = Designation::findOrFail($id);
        $designation->update($requestData);
        return redirect('designations')->with('flashMessage', 'Designation updated!');
    }

    public function destroy($id)
    {
        Designation::destroy($id);
        return redirect('designations')->with('flashMessage', 'Designation deleted!');
    }
}
