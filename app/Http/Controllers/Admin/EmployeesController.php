<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use App\Department;
use App\Designation;
use App\JobType;
use App\Employee;
use App\User;
use App\Certificate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Illuminate\Http\File;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use DB;

class EmployeesController extends Controller
{
    public function index(Request $request)
    {
        $employees = Employee::latest()->get();
        return view('admin.employees.index', compact('employees'));
    }

    public function create()
    {
        $employee     = new Employee();
        $departments  = Department::all();
        $designations = Designation::all();
        $jobTypes     = JobType::all();
        return view('admin.employees.create', compact('departments', 'designations', 'employee', 'jobTypes'));
    }

    public function store(Request $request)
    {
        $user           = new User();
        $user->name     = $request->name;
        $user->email    = $request->email;
        $user->password = Hash::make('12345678');
        $user->save();
        $user->assignRole('User');

        $employee                    = new Employee();
        $employee->user_id           = $user->id;
        $employee->department_id     = $request->department_id;
        $employee->designation_id    = $request->designation_id;
        $employee->job_type_id       = $request->job_type_id;
        $employee->full_name         = $request->full_name;
        $employee->date_of_join      = Carbon::parse($request->date_of_join)->format('Y/m/d');
        $employee->phone             = $request->phone;
        $employee->email_personal    = $request->email_personal;
        $employee->nid               = $request->nid;
        $employee->date_of_birth     = Carbon::parse($request->date_of_birth)->format('Y/m/d');
        $employee->present_address   = $request->present_address;
        $employee->permanent_address = $request->permanent_address;
        $employee->marital_status    = $request->marital_status;
        $employee->desc              = $request->desc;
        $employee->current_salary    = $request->current_salary;
        $employee->updated_by        = Auth::user()->email;
        if ($request->hasfile('image')) {
            $image                   = $request->file('image');
            $uploadPath              = 'storage/employees/';
            $employee->image         = $this->uploadImage($image, $uploadPath);
        }
        $employee->save();

        if($request->institute && $request->certificate && $request->cert_image){
            foreach ($request->file('cert_image') as $key => $value) {
                $certificate              = new Certificate();
                $certificate->emp_id      = $employee->id;
                $certificate->institute   = $request->institute[$key];
                $certificate->certificate = $request->certificate[$key];
                $cert_image               = $value;
                $cert_image_path          = 'storage/certificates/';
                $certificate->image       = $this->uploadImage($cert_image, $cert_image_path);
                $certificate->save();
            }
        }

        return redirect('employees')->with('flashMessage', 'Employee added!');
    }

    public function uploadImage($image, $uploadPath)
    {
        $now = Carbon::now();
        $imageName = $now->year.$now->month.$now->day.$now->hour.$now->minute.$now->second.Str::random(10).'.'.$image->getClientOriginalExtension();
        $image->move($uploadPath, $imageName);
        return $imageName;
    }

    public function show($id)
    {
        $employee = Employee::findOrFail($id);
        return view('admin.employees.show', compact('employee'));
    }

    public function edit($id)
    {
        $departments  = Department::all();
        $designations = Designation::all();
        $jobTypes     = JobType::all();
        $employee     = Employee::findOrFail($id);
        return view('admin.employees.edit', compact('departments', 'designations', 'employee', 'jobTypes'));
    }

    public function update(Request $request, $id)
    {
        $employee                 = Employee::findOrFail($id);

        $requestUserData          = array();
        $requestUserData['name']  = $request->name;
        $requestUserData['email'] = $request->email;
        $employee->user->update($requestUserData);

        $requestEmployeeData                      = array();
        $requestEmployeeData['full_name']         = $request->full_name;
        $requestEmployeeData['email_personal']    = $request->email_personal;
        $requestEmployeeData['date_of_join']      = Carbon::parse($request->date_of_join)->format('Y/m/d');
        $requestEmployeeData['phone']             = $request->phone;
        $requestEmployeeData['department_id']     = $request->department_id;
        $requestEmployeeData['designation_id']    = $request->designation_id;
        $requestEmployeeData['job_type_id']       = $request->job_type_id;
        $requestEmployeeData['nid']               = $request->nid;
        $requestEmployeeData['date_of_birth']     = Carbon::parse($request->date_of_birth)->format('Y/m/d');
        $requestEmployeeData['marital_status']    = $request->marital_status;
        $requestEmployeeData['present_address']   = $request->present_address;
        $requestEmployeeData['permanent_address'] = $request->permanent_address;
        $requestEmployeeData['current_salary']    = $request->current_salary;
        $requestEmployeeData['desc']              = $request->desc;
        $requestEmployeeData['updated_by']        = Auth::user()->email;
        if ($request->hasfile('image')) {
            if ($employee->image) {
                $deleteImage = 'storage/employees/'.$employee->image;
                unlink($deleteImage);
            }
            $image                        = $request->file('image');
            $uploadPath                   = 'storage/employees/';
            $requestEmployeeData['image'] = $this->uploadImage($image, $uploadPath);
        }
        $employee->update($requestEmployeeData);

        if($request->institute && $request->certificate && $request->cert_image){
            foreach ($request->file('cert_image') as $key => $value) {
                $certificate              = new Certificate();
                $certificate->emp_id      = $employee->id;
                $certificate->institute   = $request->institute[$key];
                $certificate->certificate = $request->certificate[$key];
                $cert_image               = $value;
                $cert_image_path          = 'storage/certificates/';
                $certificate->image       = $this->uploadImage($cert_image, $cert_image_path);
                $certificate->save();
            }
        }

        return redirect('employees')->with('flashMessage', 'Employee updated!');
    }

    public function destroy($id)
    {
        $employee = Employee::where('id', $id)->first();
        if ($employee->user->image) {
                $deleteUserImage = 'storage/users/'.$employee->user->image;
                unlink($deleteUserImage);
        }
        if ($employee->image) {
                $deleteEmployeeImage = 'storage/employees/'.$employee->image;
                unlink($deleteEmployeeImage);
        }
        foreach ($employee->certificates as $certificate) {
            if ($certificate->image) {
                $deleteCertificateImage = 'storage/certificates/'.$certificate->image;
                unlink($deleteCertificateImage);
            }
        }
        DB::table('users')->where('id', '=', $employee->user->id)->delete();
        return redirect('employees')->with('flashMessage', 'Employee deleted!');
    }

    public function deleteCertificate(Request $request)
    {
        if($request->certificate_id){
            $certificate = Certificate::where('id', $request->certificate_id)->first();
            $deleteImage = 'storage/certificates/'.$certificate->image;
            unlink($deleteImage);
            DB::table('certificates')->where('id', '=', $certificate->id)->delete();
            return response()->json(['msg' => 'success']);
        }
            return response()->json(['msg'=>'error']);
    }

}
