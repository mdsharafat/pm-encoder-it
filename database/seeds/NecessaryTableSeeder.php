<?php

use Illuminate\Database\Seeder;
use App\Client;
use App\Department;
use App\Designation;
use App\JobType;
use App\User;
use App\Platform;
use App\Project;
use App\ProjectNote;
use App\ProjectStatus;
use App\TaskStatus;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Carbon\Carbon;

class NecessaryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roleSuperAdmin = Role::create(['name' => 'Super Admin']);
        $roleAdmin      = Role::create(['name' => 'Admin']);
        $roleUser       = Role::create(['name' => 'User']);
        $roleClient     = Role::create(['name' => 'Client']);

        $permissionAddUser    = Permission::create(['name' => 'add-user']);
        $permissionEditUser   = Permission::create(['name' => 'edit-user']);
        $permissionViewUser   = Permission::create(['name' => 'view-user']);
        $permissionDeleteUser = Permission::create(['name' => 'delete-user']);

        $permissionAddPlatform    = Permission::create(['name' => 'add-platform']);
        $permissionEditPlatform   = Permission::create(['name' => 'edit-platform']);
        $permissionViewPlatform   = Permission::create(['name' => 'view-platform']);
        $permissionDeletePlatform = Permission::create(['name' => 'delete-platform']);

        $roleSuperAdmin->syncPermissions(Permission::all());
        $roleAdmin->syncPermissions([$permissionViewUser ,$permissionEditUser]);

        $faker = Faker\Factory::create();

        // *************************
        //user table
        $userArray = [
            0 => ['abir', 'abir@test.com', 'abir.jpg', 'Super Admin'],
            1 => ['shahed', 'shahed@test.com', 'shahed.jpg', 'Admin'],
            2 => ['sohan', 'sohan@test.com', 'sohan.jpg', 'User'],
            3 => ['salman', 'salman@test.com', 'salman.jpg', 'User']
        ];
        foreach($userArray as $item){
            $user = new User();
            $user->name = ucfirst(trans($item[0]));
            $user->email = $item[1];
            $user->password = Hash::make('11111111');
            $user->image = $item[2];
            $user->save();
            $user->assignRole($item[3]);
        }
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

        //project status table
        $projectStatusesArray = [
            'Requirements Collection',
            'Planning',
            'Defining',
            'Design',
            'Development',
            'Testing & Integration',
            'Client Feedback',
            'Complete'
        ];
        foreach($projectStatusesArray as $key => $value){
            $projectStatus = new ProjectStatus();
            $projectStatus->name = $value;
            $projectStatus->save();
        }
        // *************************

        //task status table
        $taskStatusesArray = [
            'Pending',
            'Working',
            'Submit',
            'Completed'
        ];
        foreach($taskStatusesArray as $key => $value){
            $taskStatus = new TaskStatus();
            $taskStatus->name = $value;
            $taskStatus->save();
        }
        // *************************

        //job types table
        $jobTypesArray = [
            'Internship',
            'Provision',
            'Parmanent'
        ];
        foreach($jobTypesArray as $key => $value){
            $jobType       = new JobType();
            $jobType->name = $value;
            $jobType->save();
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

        //project table
        for ($i=1; $i <=10 ; $i++) { 
            $project = new Project();
            $project->title = $faker->word;
            $project->client_id = mt_rand(1,5);
            $project->platform_id = mt_rand(1,3);
            $project->budget = mt_rand(1000,5000);
            $project->project_status_id = mt_rand(1,8);
            $project->deadline = Carbon::parse($faker->date)->format('Y/m/d');;
            $project->desc = $faker->paragraph;
            $project->git_repo = "https://github.com/mdsharafat/pm-encoder-it";
            $project->trello_link = "https://github.com/mdsharafat/pm-encoder-it";
            $project->gd_link = "https://github.com/mdsharafat/pm-encoder-it";
            $project->demo_web_link = "https://github.com/mdsharafat/pm-encoder-it";
            $project->live_project_link = "https://github.com/mdsharafat/pm-encoder-it";
            $project->save();
        }
        // *************************

        //project-notes table
        for ($i=1; $i <=10 ; $i++) {
            for ($j=1; $j <=mt_rand(2,10) ; $j++) { 
                $projectNote = new ProjectNote();
                $projectNote->project_id = $i;
                $projectNote->note = $faker->paragraph;
                $projectNote->save();        
            }
        }
    }
}
