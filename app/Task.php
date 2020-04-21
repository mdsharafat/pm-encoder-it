<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'tasks';

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
    protected $fillable = ['assigned_to', 'assigned_by', 'project_id', 'task', 'deadline', 'status', 'total_point', 'received_point'];

    public function statusName($id)
    {
        $statusArray = [
            1 => 'Assigned',
            2 => 'Reassigned',
            3 => 'In progress',
            4 => 'Submitted',
            5 => 'Completed'

        ];
        return isset($id) ? $statusArray[$id] : '';
    }

    public function assignedTo()
    {
        return $this->belongsTo(Employee::class, 'assigned_to');
    }

    public function assignedBy()
    {
        return $this->belongsTo(User::class, 'assigned_by');
    }

    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id');
    }

}
