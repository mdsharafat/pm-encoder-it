<?php
namespace App\Http\Traits;
use App\LeaveManagement;
use Carbon\Carbon;
use DB;
use Illuminate\Support\Str;

trait UniqueKeyTrait {
    protected function generateUniqueKey($model_name)
    {
        $unique_key = '';
        $is_unique  = 0;
        do {
            $unique_key = Str::random(40);
            $is_found   = $model_name::where('unique_key',$unique_key)->first();
            if($is_found == null){
                $is_unique = 1;
                break;
            }else{
                $is_unique = 0;
            }
        } while ($is_unique);

        return $unique_key;
    }
}



?>
