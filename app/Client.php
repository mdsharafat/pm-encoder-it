<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'clients';

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
    protected $fillable = ['name', 'email', 'skype', 'platform_id', 'desc', 'image'];

    public function platform()
    {
        return $this->belongsTo(Platform::class, 'platform_id');
    }

    public function projects()
    {
        return $this->hasMany(Project::class, 'project_id');
    }
    
}
