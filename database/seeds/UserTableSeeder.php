<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $admin = new User();
        $admin->name = 'admin';
        $admin->email = 'admin@admin.com';
        $admin->password = bcrypt('123456');
        $admin->save();
        $adminRole = Role::where('name', '=', 'admin')->first();
        $admin->attachRole($adminRole);

        // Create a normal user
        $user = new User();
        $user->name = 'test';
        $user->email = 'test@test.com';
        $user->password = bcrypt('123456');
        $user->save();
    }
}
