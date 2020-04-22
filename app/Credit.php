<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Credit extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'credits';

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
    protected $fillable = ['project_id', 'amount', 'date'];

    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id');
    }

}
