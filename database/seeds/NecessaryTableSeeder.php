<?php

use Illuminate\Database\Seeder;
use App\Credit;
use App\Client;
use App\Department;
use App\Designation;
use App\Employee;
use App\LeaveManagement;
use App\User;
use App\MiscellaneousExpense;
use App\Platform;
use App\Project;
use App\ProjectNote;
use App\Review;
use App\SalaryExpense;
use App\Task;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Carbon\Carbon;
use Illuminate\Support\Str;

class NecessaryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roleAdmin      = Role::create(['name' => 'Admin']);
        $roleUser       = Role::create(['name' => 'User']);

        Permission::create(['name' => 'add-department']);
        Permission::create(['name' => 'edit-department']);
        Permission::create(['name' => 'view-department']);
        Permission::create(['name' => 'delete-department']);

        Permission::create(['name' => 'add-designation']);
        Permission::create(['name' => 'edit-designation']);
        Permission::create(['name' => 'view-designation']);
        Permission::create(['name' => 'delete-designation']);

        Permission::create(['name' => 'add-employee']);
        Permission::create(['name' => 'edit-employee']);
        Permission::create(['name' => 'view-employee-list']);
        Permission::create(['name' => 'view-employee-details']);
        Permission::create(['name' => 'delete-employee']);

        Permission::create(['name' => 'view-leave']);
        Permission::create(['name' => 'approval-leave']);

        Permission::create(['name' => 'add-task']);
        Permission::create(['name' => 'view-task']);
        Permission::create(['name' => 'feedback-task']);
        Permission::create(['name' => 'update-task']);
        Permission::create(['name' => 'delete-task']);

        $roleAdmin->syncPermissions(Permission::all());

        $faker = Faker\Factory::create();

        // *************************
        //user table (super admin user)
        $user = new User();
        $user->name = "Abir";
        $user->email = 'abir@test.com';
        $user->password = Hash::make('11111111');
        $user->image = 'abir.jpg';
        $user->save();
        $user->assignRole('admin');
        // *************************

        //platform table
        $platformArray = [
            0 => ['Upwork', 5.0],
            1 => ['Freelancer', 5.0],
            2 => ['Local', 5.0]
        ];
        foreach($platformArray as $item){
            $platform          = new Platform();
            $platform->name    = $item[0];
            $platform->ratings = $item[1];
            $platform->save();
        }
        // *************************

        //client table
        for ($i=1; $i <=5 ; $i++) {
            $client = new Client();
            $client->name = $faker->name;
            $client->email = 'client_'.$i.'@test.com';
            $client->platform_id = mt_rand(1,2);
            $client->desc = $faker->paragraph;
            $client->save();
        }
        // *************************

        //departments table
        $departmentsArray = [
            'Backend Development',
            'Digital Marketing',
            'Graphic Design',
            'HRM',
            'Frontend Development'
        ];
        foreach($departmentsArray as $key => $value){
            $department = new Department();
            $department->name = $value;
            $department->save();
        }
        // *************************

        //designation table
        $designationsArray = [
            'Frontend Developer',
            'Graphic Designer',
            'Laravel Developer',
            'Nodejs Developer',
            'Wordpress Developer'
        ];
        foreach($designationsArray as $key => $value){
            $designation = new Designation();
            $designation->name = $value;
            $designation->save();
        }
        // *************************

        //employees table
        // $employeeArray = [
        //     0 => ['shahed', 'Shahed Romel', 'shahed@test.com', 'User', 250],
        //     1 => ['sohan', 'Sharafat Hossain', 'sohan@test.com', 'User', 200],
        //     2 => ['salman', 'Salman Khan', 'salman@test.com', 'User', 300],
        //     3 => ['sajal', 'Sajal Kundu', 'sajal@test.com', 'User', 220],
        //     4 => ['saifullah', 'Saiful Islam', 'saifullah@test.com', 'User', 180],
        //     5 => ['ismam', 'Ismam Hasan', 'ismam@test.com', 'User', 150],
        //     6 => ['ben', 'Benamin Mukammel', 'ben@test.com', 'User', 230],
        //     7 => ['tkc', 'Tanvir Khan', 'tkc@test.com', 'User', 230],
        //     8 => ['ibnul', 'Ibnul Hasan', 'ibnul@test.com', 'User', 200],
        //     9 => ['tanin', 'Tanin Ansari', 'tanin@test.com', 'User', 200],
        // ];

        // foreach($employeeArray as $item){
        //     $user           = new User();
        //     $user->name     = ucfirst(trans($item[0]));
        //     $user->email    = $item[2];
        //     $user->password = Hash::make('11111111');
        //     $user->save();
        //     $user->assignRole($item[3]);

        //     $employee                    = new Employee();
        //     $employee->user_id           = $user->id;
        //     $employee->department_id     = mt_rand(1,5);
        //     $employee->designation_id    = mt_rand(1,5);
        //     $employee->job_type_id       = mt_rand(1,4);
        //     $employee->full_name         = $item[1];
        //     $employee->date_of_join      = $faker->date($format = 'Y/m/d', $max = 'now');
        //     $employee->phone             = $faker->randomNumber;
        //     $employee->email_personal    = $faker->email;
        //     $employee->nid               = $faker->numberBetween($min = 1000000000000, $max = 9000000000000);
        //     $employee->date_of_birth     = $faker->date($format = 'Y/m/d', $max = 'now');
        //     $employee->present_address   = $faker->address;
        //     $employee->permanent_address = $faker->address;
        //     $employee->marital_status    = mt_rand(0,1);
        //     $employee->gender            = 1;
        //     $employee->desc              = $faker->text;
        //     $employee->current_salary    = mt_rand(180, 250);
        //     $employee->updated_by        = 'abir@test.com';
        //     $employee->save();
        // }
        // *************************

        //project table
        // $projectNameArray = [
        //     0 => ['Econosurance', 2000, 100],
        //     1 => ['Claimnwin', 1000, 50],
        //     2 => ['Mkhdom', 2000, 100],
        //     3 => ['Bumble Bee Baby Sitter', 3000, 100],
        //     4 => ['Lullabysleep', 2000, 50],
        //     5 => ['The idries Shah Foundation', 2000, 50],
        //     6 => ['Ecomed', 500, 100],
        //     7 => ['My Money Life', 500, 30],
        //     8 => ['Twilio SMS Manager', 1500, 50],
        //     9 => ['Blog For Sea Fish', 500, 20]
        // ];
        // for ($i=0; $i <10 ; $i++) {
        //     $project                    = new Project();
        //     $project->title             = $projectNameArray[$i][0];
        //     $project->client_id         = mt_rand(1,5);
        //     $project->platform_id       = mt_rand(1,3);
        //     $project->budget            = $projectNameArray[$i][1];
        //     $project->deadline          = Carbon::parse($faker->date)->format('Y/m/d');
        //     $project->desc              = $faker->paragraph;
        //     $project->git_repo          = "https://github.com/mdsharafat/pm-encoder-it";
        //     $project->trello_link       = "https://github.com/mdsharafat/pm-encoder-it";
        //     $project->gd_link           = "https://github.com/mdsharafat/pm-encoder-it";
        //     $project->demo_web_link     = "https://github.com/mdsharafat/pm-encoder-it";
        //     $project->live_project_link = "https://github.com/mdsharafat/pm-encoder-it";
        //     $project->save();
        // }
        // *************************

        //project-notes table
        // for ($i=1; $i <=10 ; $i++) {
        //     for ($j=1; $j <=mt_rand(2,10) ; $j++) {
        //         $projectNote = new ProjectNote();
        //         $projectNote->project_id = $i;
        //         $projectNote->note = $faker->paragraph;
        //         $projectNote->save();
        //     }
        // }

        //leave-managements table
        // for ($i=1; $i <= 10; $i++) {
        //     for ($j=1; $j <= 10 ; $j++) {
        //         $leaveApplication             = new LeaveManagement();
        //         $leaveApplication->emp_id     = $i;
        //         $leaveApplication->unique_key = Str::random(40);
        //         $leaveApplication->status     = 1;
        //         $leaveApplication->category   = mt_rand(1,4);
        //         $leaveApplication->date       = Carbon::parse($faker->date)->format('Y/m/d');
        //         $leaveApplication->reason     = $faker->text;
        //         $leaveApplication->save();
        //     }
        // }
        // *************************

        //task table
        // for ($i=1; $i <=10 ; $i++) {
        //     for ($j=1; $j <= mt_rand(9,10) ; $j++) {
        //         $task              = new Task();
        //         $task->assigned_to = $i;
        //         $task->assigned_by = 1;
        //         $task->project_id  = $j;
        //         $task->unique_key  = Str::random(40);
        //         $task->status      = mt_rand(1,4);
        //         $task->deadline    = Carbon::parse($faker->dateTime)->format('Y/m/d H:i');
        //         $task->total_point = mt_rand(10,20);
        //         $task->task        = $faker->text;
        //         $task->save();

        //         $employee = Employee::where('id', $i)->first();
        //         $employee->projects()->attach($j);
        //     }
        // }
        // *************************

        //salary expenses table
        // $dateArray = ['12/10/2019', '1/10/2020', '2/10/2020', '3/10/2020', '4/10/2020'];

        // for ($i=0; $i < 10 ; $i++) {
        //     for ($j=0; $j < 5; $j++) {
        //         $salaryExpense         = new SalaryExpense();
        //         $salaryExpense->emp_id = $i+1;
        //         $salaryExpense->amount = $employeeArray[$i][4];
        //         $salaryExpense->date   = Carbon::parse($dateArray[$j])->format('Y/m/d');
        //         $salaryExpense->save();
        //     }
        // }
        // *************************

        //miscellaneous expenses table
        // $miscellExpenseArray = [
        //     0 => ['House Rent', 250],
        //     1 => ['Internet', 50],
        //     2 => ['Food', 300],
        //     3 => ['Mobile Bill', 10]
        // ];

        // for ($i=0; $i < 5 ; $i++) {
        //     for ($j=0; $j < 4 ; $j++) {
        //         $miscellExpense         = new MiscellaneousExpense();
        //         $miscellExpense->name   = $miscellExpenseArray[$j][0];
        //         $miscellExpense->amount = $miscellExpenseArray[$j][1];
        //         $miscellExpense->date   = Carbon::parse($dateArray[$i])->format('Y/m/d');
        //         $miscellExpense->save();
        //     }
        // }
        // *************************

        //credits table
        // for ($i=0; $i < 10 ; $i++) {
        //     for ($j=0; $j < 5; $j++) {
        //         $credit             = new Credit();
        //         $credit->project_id = $i+1;
        //         $credit->amount     = $projectNameArray[$i][2];
        //         $credit->date       = Carbon::parse($dateArray[$j])->format('Y/m/d');
        //         $credit->save();
        //     }
        // }

        // *************************

        //reviews table
        // for ($i=1; $i <= 10; $i++) {
        //     for ($j=0; $j < 25; $j++) {
        //         $review              = new Review();
        //         $review->emp_id      = $i;
        //         $review->point       = mt_rand(0,5);
        //         $review->note        = $faker->sentence;
        //         $review->reviewed_by = 1;
        //         $review->save();
        //     }
        // }
    }
}
