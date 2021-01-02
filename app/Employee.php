<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Employee extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'employees';

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'department_id',
        'designation_id',
        'job_type_id',
        'full_name',
        'date_of_join',
        'phone',
        'email_personal',
        'nid',
        'image',
        'date_of_birth',
        'present_address',
        'permanent_address',
        'marital_status',
        'gender',
        'desc',
        'current_salary',
        'updated_by',
        'job_status',
        'date_of_resign',
        'reason_of_resign'
    ];

    public function genderName($id) {
        $genderArray = [
            1 => 'Male',
            2 => 'Female',
            3 => 'Others'
        ];
        return isset($id) ? $genderArray[$id] : '';
    }
    public function maritalStatus($id) {
        $maritalStatusArray = [
            0 => 'Unmarried',
            1 => 'Married',
        ];
        return isset($id) ? $maritalStatusArray[$id] : '';
    }

    public function jobStatusName($id) {
        $jobStatusArray = [
            0 => 'Running',
            1 => 'Former',
        ];
        return isset($id) ? $jobStatusArray[$id] : '';
    }

    public function dateOfJoin($date) {
        $date_of_join = \Carbon\Carbon::parse($date);
        $now          = \Carbon\Carbon::now();
        $experience   = $date_of_join->diff(\Carbon\Carbon::now())->format("%y years, %m months and %d days");
        if($now > $date){
            return $experience;
        }else{
            return '';
        }
    }

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function department() {
        return $this->belongsTo(Department::class, 'department_id');
    }

    public function designation() {
        return $this->belongsTo(Designation::class, 'designation_id');
    }

    public function jobTypeName($jobType) {
        $jobTypeArray = [
            1 => 'Parmanent',
            2 => 'Provision',
            3 => 'Part Time',
            4 => 'Internship'
        ];
        return isset($jobType) ? $jobTypeArray[$jobType] : '';
    }

    public function certificates() {
        return $this->hasMany(Certificate::class, 'emp_id');
    }

    public function contributions() {
        return $this->hasMany(Contributions::class, 'emp_id');
    }

    public function leaves() {
        return $this->hasMany(LeaveManagement::class, 'emp_id');
    }

    public function cumulativeLeave() {
        if($this->leaves()->where('status', 2)->count() > 0){
            return $this->leaves()->where('status', 2)->count();
        }else{
            return "0";
        }
    }

    public function reviews() {
        return $this->hasMany(Review::class, 'emp_id');
    }

    public function averageReview() {
        $count = $this->reviews()->count();
        $totalReviewPoint = $this->reviews()->sum('point');
        if($count > 0){
            $averageReview = number_format(($totalReviewPoint / $count),2);
        }else{
            $averageReview = '0.00';
        }
        return $averageReview;
    }

    public function projects() {
        return $this->belongsToMany(Project::class, 'employee_project', 'emp_id', 'project_id')->withTimestamps();
    }

    public function totalProjects() {
        return $this->projects()->groupBy('project_id')->get();
    }

    public function runningProjects() {
        return $this->projects()->groupBy('project_id')->where('status', 0)->get();
    }

    public function salaries() {
        return $this->hasMany(SalaryExpense::class, 'emp_id');
    }

    public function cumulativeSalary() {
        if($this->salaries()->sum('amount') > 0){
            return $this->salaries()->sum('amount');
        }else{
            return '0';
        }
    }

    public function dateOfResign() {
        if(!empty($this->date_of_resign)){
            return $this->date_of_resign;
        }else{
            return '- - - - - -';
        }
    }

    public function reasonOfResign() {
        if(!empty($this->reason_of_resign)){
            return $this->reason_of_resign;
        }else{
            return '- - - - - -';
        }
    }

    public function currentlyInvolvedProjects($emp_id) {
        $total_project = DB::table('employee_project')
                    ->selectRaw('count(project_id) as total_involved_project')
                    ->where('emp_id', $emp_id)
                    ->first();
        return ($total_project->total_involved_project);
    }
}
