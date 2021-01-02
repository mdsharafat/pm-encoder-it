<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use App\Department;
use App\Designation;
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
use App\Http\Traits;

class EmployeesController extends Controller
{
    use Traits\UniqueKeyTrait;

    public function index(Request $request)
    {
        $employees = Employee::latest()->get();
        return view('admin.employees.index', compact('employees'));
    }

    public function allRunningProjects($unique_key) {
        $employee = DB::table('employees')
                    ->where('unique_key', $unique_key)
                    ->select('full_name')
                    ->first();
        $runningProjects = DB::table('employee_project')
                        ->join('projects', 'projects.id', 'employee_project.project_id')
                        ->join('employees', 'employees.id', 'employee_project.emp_id')
                        ->where('employee_project.emp_id', Employee::where('unique_key', $unique_key)->first()->id)
                        ->where('projects.status', 0)
                        ->select('projects.title as title', 'projects.budget as budget', 'projects.deadline as deadline', 'employees.full_name as name', 'employees.image as image')
                        ->groupBy('employee_project.project_id')
                        ->get();
        return view('admin.employees.running-projects', compact('employee', 'runningProjects'));
    }

    public function create() {
        $employee     = new Employee();
        $departments  = Department::all();
        $designations = Designation::all();
        return view('admin.employees.create', compact('departments', 'designations', 'employee'));
    }

    public function store(Request $request) {
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
        $employee->unique_key        = $this->generateUniqueKey(get_class($employee));
        $employee->full_name         = $request->full_name;
        $employee->date_of_join      = Carbon::parse($request->date_of_join)->format('Y/m/d');
        $employee->phone             = $request->phone;
        $employee->email_personal    = $request->email_personal;
        $employee->nid               = $request->nid;
        $employee->date_of_birth     = Carbon::parse($request->date_of_birth)->format('Y/m/d');
        $employee->present_address   = $request->present_address;
        $employee->permanent_address = $request->permanent_address;
        $employee->marital_status    = $request->marital_status;
        $employee->gender            = $request->gender;
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

    public function uploadImage($image, $uploadPath) {
        $now = Carbon::now();
        $imageName = $now->year.$now->month.$now->day.$now->hour.$now->minute.$now->second.Str::random(10).'.'.$image->getClientOriginalExtension();
        $image->move($uploadPath, $imageName);
        return $imageName;
    }

    public function myEmployeeProfile() {
        $employee = Auth::user()->employee;
        return view('admin.employees.show', compact('employee'));
    }

    public function show($unique_key) {
        $employee = Employee::where('unique_key', $unique_key)->first();
        return view('admin.employees.show', compact('employee'));
    }

    public function edit($unique_key) {
        $departments  = Department::all();
        $designations = Designation::all();
        $employee     = Employee::where('unique_key', $unique_key)->first();
        return view('admin.employees.edit', compact('departments', 'designations', 'employee'));
    }

    public function update(Request $request, $unique_key) {
        $employee                 = Employee::where('unique_key', $unique_key)->first();

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
        $requestEmployeeData['gender']            = $request->gender;
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

    public function destroy($unique_key) {
        $employee = Employee::where('unique_key', $unique_key)->first();
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

    public function deleteCertificate(Request $request) {
        if($request->certificate_id){
            $certificate = Certificate::where('id', $request->certificate_id)->first();
            $deleteImage = 'storage/certificates/'.$certificate->image;
            unlink($deleteImage);
            DB::table('certificates')->where('id', '=', $certificate->id)->delete();
            return response()->json(['msg' => 'success']);
        }
            return response()->json(['msg'=>'error']);
    }

    public function employeeDashboard() {
        $appliedLeaves = DB::table('leave_managements')
                ->where('emp_id', '=', Auth::user()->employee->id)
                ->where('status', '=', 1)
                ->select(DB::raw('count(*) as count'))
                ->first();

        $approvedLeaves = DB::table('leave_managements')
                ->where('emp_id', '=', Auth::user()->employee->id)
                ->where('status', '=', 2)
                ->select(DB::raw('count(*) as count'))
                ->first();

        return view('admin.employees.employee-dashboard', compact('appliedLeaves', 'approvedLeaves'));
    }

    public function employeeSchedule() {
        $employees = Employee::all();
        return view('admin.employees.employee-schedule', compact('employees'));
    }

    public function checkEmployeeSchedule(Request $request) {
        $employee = Employee::where('unique_key', $request->emp_id)->first();

        $schedules = DB::table('employee_project')
                        ->join('projects', 'projects.id', 'employee_project.project_id')
                        ->where('employee_project.emp_id', '=', $employee->id)
                        ->select('projects.title', 'projects.starts_from', 'projects.deadline')
                        ->get();
//        $schedule_object_array = [];
//        foreach ($schedules as $schedule) {
//            $schedule_object = new \stdClass();
//            $schedule_object->title = $schedule->title;
//            $schedule_object->start = $schedule->starts_from;
//            $schedule_object->end = $schedule->deadline;
//            array_push($schedule_object_array, $schedule_object);
//        }
        return response()->json([
            'msg' => 'success',
            'schedule' => $schedules
        ]);
    }

}
