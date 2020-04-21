<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\Employee;
use App\LeaveManagement;
use Carbon\Carbon;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use DB;

class LeaveManagementsController extends Controller
{
    public function index(Request $request)
    {
        // $employeeIds    = LeaveManagement::select('emp_id')->distinct()->pluck('emp_id')->toArray();
        // $employeesLeave = Employee::whereIn('id', $employeeIds)->get();

        $employeesLeave = LeaveManagement::selectRaw('count(*) AS totalPending, emp_id, unique_key')->where('status', 1)->groupBy('emp_id')->get();

        // $employeesLeave = LeaveManagement::select('emp_id', DB::raw('COUNT(emp_id) as totalPending'))
        //     ->with('employee')
        //     ->groupBy('emp_id')
        //     ->where('status', 1)
        //     ->get();

        // foreach ($employeesLeave as $value) {
        //     dump($value->unique_key);
        // }

        // dd($employeesLeave);


        return view('admin.leave-managements.index', compact('employeesLeave'));
    }

    public function create()
    {
        return view('admin.leave-managements.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'date' => 'required|date',
            'category' => 'required|integer|between:1,4',
            'reason' => 'required',
        ]);
        $leaveApplication             = new LeaveManagement();
        $leaveApplication->emp_id     = Auth::user()->employee->id;
        $leaveApplication->unique_key = $this->generateUniqueKey();
        $leaveApplication->status     = 1;
        $leaveApplication->date       = Carbon::parse($request->date)->format('Y/m/d');
        $leaveApplication->category   = $request->category;
        $leaveApplication->reason     = $request->reason;
        $leaveApplication->save();
        return redirect('/my-leave-applications-pending')->with('flashMessage', 'Leave Application Sent For Approval.');
    }

    protected function generateUniqueKey()
    {
        $unique_key = '';
        $is_unique  = 0;
        do {
            $unique_key = Str::random(40);
            $is_found   = LeaveManagement::where('unique_key',$unique_key)->first();
            if($is_found == null){
                $is_unique = 1;
                break;
            }else{
                $is_unique = 0;
            }
        } while ($is_unique);

        return $unique_key;
    }

    public function show($id)
    {
        $leavemanagement = LeaveManagement::findOrFail($id);
        return view('admin.leave-managements.show', compact('leavemanagement'));
    }

    public function edit($unique_key)
    {
        $leavemanagement = LeaveManagement::where('unique_key', $unique_key)->first();
        return view('admin.leave-managements.edit', compact('leavemanagement'));
    }

    public function update(Request $request, $unique_key)
    {
        $leavemanagement         = LeaveManagement::where('unique_key', $unique_key)->first();
        $requestData             = array();
        $requestData['date']     = Carbon::parse($request->date)->format('Y/m/d');
        $requestData['category'] = $request->category;
        $requestData['reason']   = $request->reason;
        $leavemanagement->update($requestData);
        return redirect('/my-leave-applications-pending')->with('flashMessage', 'Leave Application Updated.');
    }

    public function destroy($id)
    {
        LeaveManagement::destroy($id);
        return redirect()->back()->with('flashMessage', 'Leave Application deleted!');
    }

    public function myLeaveApplicationPending()
    {
        $leaveApplications = LeaveManagement::where('emp_id', Auth::user()->employee->id)->where('status', 1)->get();
        return view('admin.leave-managements.my-leave-applications-pending', compact('leaveApplications'));
    }

    public function myLeaveApplicationSummary()
    {
        $leaveApplications = LeaveManagement::where('emp_id', Auth::user()->employee->id)->whereIn('status', [2,3])->get();
        return view('admin.leave-managements.my-leave-applications-summary', compact('leaveApplications'));
    }

    public function leavePendingUniqueUser($emp_id)
    {
        $employeeName = Employee::selectRaw('full_name, department_id')->where('id', $emp_id)->first();
        $leavePending = LeaveManagement::where('status', 1)->where('emp_id', $emp_id)->get();
        return view('admin.leave-managements.total-leave-pending-unique-user', compact('leavePending', 'employeeName'));
    }

    public function leaveApprovedUniqueUser($emp_id)
    {
        $employeeName = Employee::selectRaw('full_name, department_id')->where('id', $emp_id)->first();
        $leaveApproved = LeaveManagement::where('status', 2)->where('emp_id', $emp_id)->get();
        return view('admin.leave-managements.total-leave-approved-unique-user', compact('leaveApproved', 'employeeName'));
    }

    public function leaveRejectedUniqueUser($emp_id)
    {
        $employeeName = Employee::selectRaw('full_name, department_id')->where('id', $emp_id)->first();
        $leaveRejected = LeaveManagement::where('status', 3)->where('emp_id', $emp_id)->get();
        return view('admin.leave-managements.total-leave-rejected-unique-user', compact('leaveRejected', 'employeeName'));
    }

    public function approveLeaveSingle($id,$emp_id)
    {
        DB::table('leave_managements')
              ->where('id', $id)
              ->where('emp_id', $emp_id)
              ->update(['status' => 2, 'action_by' => Auth::user()->email]);
        return redirect()->back()->with('flashMessage', 'Leave Approved');
    }

    public function rejectLeaveSingle($id,$emp_id)
    {
        DB::table('leave_managements')
              ->where('id', $id)
              ->where('emp_id', $emp_id)
              ->update(['status' => 3, 'action_by' => Auth::user()->email]);
        return redirect()->back()->with('flashMessage', 'Leave Rejected');
    }

    public function approveLeaveAll($emp_id)
    {
        $data = LeaveManagement::where('emp_id', $emp_id)->where('status', 1)->pluck('emp_id')->toArray();
        foreach($data as $key => $value){
            DB::table('leave_managements')
              ->where('emp_id', $value)
              ->where('status', 1)
              ->update(['status' => 2, 'action_by' => Auth::user()->email]);
        }
        return redirect()->back()->with('flashMessage', 'All Approved');
    }

    public function rejectLeaveAll($emp_id)
    {
        $data = LeaveManagement::where('emp_id', $emp_id)->where('status', 1)->pluck('emp_id')->toArray();
        foreach($data as $key => $value){
            DB::table('leave_managements')
              ->where('emp_id', $value)
              ->where('status', 1)
              ->update(['status' => 3, 'action_by' => Auth::user()->email]);
        }
        return redirect()->back()->with('flashMessage', 'All Rejected');
    }

    public function approvedLeaveList()
    {
        $employeesLeave = LeaveManagement::selectRaw('count(*) AS totalPending, emp_id, unique_key')->where('status', 2)->groupBy('emp_id')->get();
        return view('admin.leave-managements.approved-list', compact('employeesLeave'));
    }

    public function rejectedLeaveList()
    {
        $employeesLeave = LeaveManagement::selectRaw('count(*) AS totalPending, emp_id, unique_key')->where('status', 3)->groupBy('emp_id')->get();
        return view('admin.leave-managements.rejected-list', compact('employeesLeave'));
    }
}
