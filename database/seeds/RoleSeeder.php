<?php

use Illuminate\Database\Seeder;
use App\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $owner = new ROle();
        $owner->name = 'admin';
        $owner->display_name = '超级管理员'; //optional
        $owner->description = '最该权限'; //optional
        $owner->save();

        $common = new Role();
        $common->name = 'editor';
        $common->display_name = '编辑'; //optional
        $common->description = '后台编辑'; //optional
        $common->save();

    }
}
