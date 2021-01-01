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
    protected $fillable = ['unique_key', 'title', 'client_id', 'platform_id', 'budget', 'project_status_id', 'deadline', 'desc', 'git_repo', 'trello_link', 'gd_link', 'demo_web_link', 'live_project_link', 'feedback_from_client', 'feedback_to_client', 'payment_status', 'payment_received'];

    public function statusName($id)
    {
        $statusArray = [
            0 => 'In Progress',
            1 => 'Completed'
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

    public function contributions()
    {
        return $this->hasMany(Contribution::class, 'project_id');
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
