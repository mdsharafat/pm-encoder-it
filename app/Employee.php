<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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

    public function genderName($id)
    {
        $genderArray = [
            1 => 'Male',
            2 => 'Female',
            3 => 'Others'
        ];
        return isset($id) ? $genderArray[$id] : '';
    }
    public function maritalStatus($id)
    {
        $maritalStatusArray = [
            0 => 'Unmarried',
            1 => 'Married',
        ];
        return isset($id) ? $maritalStatusArray[$id] : '';
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id');
    }

    public function designation()
    {
        return $this->belongsTo(Designation::class, 'designation_id');
    }

    public function jobType()
    {
        return $this->belongsTo(JobType::class, 'job_type_id');
    }

    public function certificates()
    {
        return $this->hasMany(Certificate::class, 'emp_id');
    }

    public function leaves()
    {
        return $this->hasMany(LeaveManagement::class, 'emp_id');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class, 'emp_id');
    }

    public function tasks()
    {
        return $this->hasMany(Task::class, 'assigned_to');
    }

    public function projects()
    {
        return $this->belongsToMany(Project::class, 'employee_project', 'emp_id', 'project_id')->withTimestamps();
    }

    public function salaries()
    {
        return $this->hasMany(SalaryExpense::class, 'emp_id');
    }
}
