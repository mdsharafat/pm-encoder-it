<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Http\Traits;
use DB;

class Contribution extends Model
{
    use Traits\UniqueKeyTrait;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'contributions';

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
    protected $fillable = ['project_id', 'emp_id', 'contribution', 'unique_key', 'comment'];

    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id');
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'emp_id');
    }

    public function has_unique_key($project_id) {
        $has_unique_key = Contribution::selectRaw('unique_key, project_id')->where('project_id', $project_id)->first();
        if(is_null($has_unique_key)){
            $unique_key = $this->generateUniqueKey(get_class($this));
        }else {
            $unique_key = $has_unique_key->unique_key;
        }
        return $unique_key;
    }

    public static function projectWiseEmployeeContribution($project, $employee){
        $result = [];
        $remaining = Contribution::selectRaw('(100 - SUM(contribution)) AS remaining')->where('project_id', $project)->first();
        $emp_contribution = DB::table("contributions")
                            ->join("employees", "contributions.emp_id", "=", "employees.id")
                            ->join("projects", "contributions.project_id", "=", "projects.id")
                            ->select("contributions.contribution as contribution", "contributions.unique_key as unique_key", "contributions.id as unique_id", "contributions.project_id as project_id", "contributions.emp_id as emp_id", "employees.full_name as emp_name", "projects.title as project_name")
                            ->where("contributions.project_id", $project)
                            ->where("contributions.emp_id", $employee)
                            ->first();
        $result["remaining"] = $remaining;
        $result["emp_contribution"] = $emp_contribution;
        return $result;
    }
}
