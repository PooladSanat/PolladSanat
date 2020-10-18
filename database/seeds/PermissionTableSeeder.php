<?php

use Illuminate\Database\Seeder;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            'ثبت کاربر جدید',
            'لیست کاربران',
            'ثبت بخش جدید',
            'لیست بخش ها',
            'ویرایش کاربران',
            'فعال و غیر فعال کردن کاربران'
        ];


        foreach ($permissions as $permission) {
            \App\Permission::create(['name' => $permission]);
        }
    }
}
