<?php

use Illuminate\Database\Seeder;
use App\Client;
use App\User;
use App\Platform;
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

        //platform table
        $platformArray = [
            0 => ['upwork', 5.0],
            1 => ['freelance', 5.0]
        ];

        foreach($platformArray as $item){
            $platform          = new Platform();
            $platform->name    = $item[0];
            $platform->ratings = $item[1];
            $platform->save();
        }

        //client table
        for ($i=1; $i <=5 ; $i++) { 
            $client = new Client();
            $client->name = $faker->name;
            $client->email = 'client_'.$i.'@test.com';
            $client->platform_id = mt_rand(1,2);
            $client->desc = $faker->paragraph;
            $client->save();
        }
    }
}
