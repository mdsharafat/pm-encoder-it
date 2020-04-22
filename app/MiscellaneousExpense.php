<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MiscellaneousExpense extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'miscellaneous_expenses';

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
    protected $fillable = ['name', 'amount', 'date'];

    
}
