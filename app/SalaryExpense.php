<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SalaryExpense extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'salary_expenses';

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
    protected $fillable = ['emp_id', 'amount', 'date'];

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'emp_id');
    }

}
