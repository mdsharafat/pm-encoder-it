<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'projects';

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
    protected $fillable = ['title', 'client_id', 'platform_id', 'budget', 'project_status_id', 'deadline', 'desc', 'git_repo', 'trello_link', 'gd_link', 'demo_web_link', 'live_project_link', 'feedback_from_client', 'feedback_to_client', 'payment_status', 'payment_received'];

    public function statusName($id)
    {
        $statusArray = [
            0 => 'In Progress',
            1 => 'Completed',

        ];
        return isset($id) ? $statusArray[$id] : '';
    }

    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }

    public function platform()
    {
        return $this->belongsTo(Platform::class, 'platform_id');
    }

    public function projectStatus()
    {
        return $this->belongsTo(ProjectStatus::class, 'project_status_id');
    }

    public function projectNotes()
    {
        return $this->hasMany(ProjectNote::class, 'project_id');
    }

    public function tasks()
    {
        return $this->hasMany(Task::class, 'project_id');
    }

    public function projectContribution($empId)
    {
        $totalPoint    = $this->tasks()->sum('total_point');
        $receivedPoint = $this->tasks()->where('assigned_to', $empId)->sum('received_point');
        $contribution  = number_format(floor(($receivedPoint * 100) / ($totalPoint)) ,2);
        return $contribution;
    }

    public function countTotalTaskPoint()
    {
        return $this->tasks()->sum('total_point');
    }

    public function completedTaskPointCount()
    {
        return $this->tasks()->where('status', 5)->sum('total_point');
    }

    public function percentageOfCompletion()
    {
        if($this->countTotalTaskPoint() != null){
            return (number_format(($this->completedTaskPointCount() * 100) / $this->countTotalTaskPoint(),2));
        }else{
            return '0';
        }
    }

    public function employees()
    {
        return $this->belongsToMany(Employee::class, 'employee_project', 'project_id', 'emp_id')->withTimestamps();
    }

    public function credits()
    {
        return $this->hasMany(Credit::class, 'project_id');
    }
}
