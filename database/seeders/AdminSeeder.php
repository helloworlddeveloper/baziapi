<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    public $users = [
        'admin',
        'admins',
        'administrator',
        'administrators',
        'system',
        'sa',
        'root',
        '平台总管理',
        '平台管理',
        '系统总管理',
        '系统总管理员',
        '系统总编辑',
        '系统',
        '系统管理',
        '系统管理员',
        '习近平',
        '管理员',
    ];

    public function run()
    {
        foreach ($this->users as $user) {
            \DB::table('admins')->insert([
                'username' => $user,
                'password' => \Hash::make('aidybnt@1234A')
            ]);
        }
    }
}
