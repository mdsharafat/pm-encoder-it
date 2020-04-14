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
}
