<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Platform extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'platforms';

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
    protected $fillable = ['name', 'ratings'];

    public function clients()
    {
        return $this->hasMany(Client::class, 'platform_id');
    }

    public function projects()
    {
        return $this->hasMany(Project::class, 'platform_id');
    }
    
}
