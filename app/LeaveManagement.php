<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LeaveManagement extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'leave_managements';

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
    protected $fillable = ['emp_id', 'unique_key', 'status', 'category', 'date', 'reason', 'action_by'];

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'emp_id');
    }

    public function categoryName($id)
    {
        $categoryArray = [
            1 => 'Casual Leave',
            2 => 'Medical Leave',
            3 => 'Paternity Leave',
            4 => 'Maternity Leave'
        ];
        return isset($id) ? $categoryArray[$id] : '';
    }

    public function statusName($id)
    {
        $statusArray = [
            1 => 'Pending',
            2 => 'Approved',
            3 => 'Rejected'
        ];
        return isset($id) ? $statusArray[$id] : '';
    }

}
