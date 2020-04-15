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
        'desc',
        'current_salary',
        'updated_by',
        'job_status',
        'date_of_resign',
        'reason_of_resign'
    ];

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

}
