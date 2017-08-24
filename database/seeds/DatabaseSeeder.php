<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);

    	$this->call(RoleSeeder::class);
    	//写入管理员
    	$this->call(UserTableSeeder::class);
    	//写入区域
    	$this->call(RegionTableSeeder::class);
    }
}
