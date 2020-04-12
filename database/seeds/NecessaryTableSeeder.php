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
        $roleSuperAdmin = Role::create(['name' => 'Super Admin']);
        $roleAdmin      = Role::create(['name' => 'Admin']);
        $roleUser       = Role::create(['name' => 'User']);

        $permissionAddUser    = Permission::create(['name' => 'add-user']);
        $permissionEditUser   = Permission::create(['name' => 'edit-user']);
        $permissionDeleteUser = Permission::create(['name' => 'delete-user']);

        $roleSuperAdmin->syncPermissions(Permission::all());
        $roleAdmin->givePermissionTo($permissionEditUser);
        
        $faker = Faker\Factory::create();

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
    }
}
