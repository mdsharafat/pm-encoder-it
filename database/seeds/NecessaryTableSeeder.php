<?php

use Illuminate\Database\Seeder;
use App\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class NecessaryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roleSuperAdmin = Role::create(['name' => 'admin']);
        $roleAdmin      = Role::create(['name' => 'project-manager']);
        $roleTeamLead   = Role::create(['name' => 'team-lead']);
        $roleUser       = Role::create(['name' => 'user']);

        $permissionAddUser = Permission::create(['name' => 'add user']);
        // $roleSuperAdmin->givePermissionTo($permission);
        
        $faker = Faker\Factory::create();

        $userArray = [
            0 => ['abir', 'abir@test.com', 'abir.jpg', 'admin'],
            1 => ['shahed', 'shahed@test.com', 'shahed.jpg', 'project-manager'],
            2 => ['sohan', 'sohan@test.com', 'sohan.jpg', 'team-lead'],
            3 => ['salman', 'salman@test.com', 'salman.jpg', 'user']
        ];

        foreach($userArray as $item){
            $user = new User();
            $user->name = $item[0];
            $user->email = $item[1];
            $user->password = Hash::make('11111111');
            $user->image = $item[2];
            $user->save();
            $user->assignRole($item[3]);
        }
    }
}
