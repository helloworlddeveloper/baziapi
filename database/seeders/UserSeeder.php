<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public $users = [
        'aa',
        'bb',
        'cc',
        'dd',
        'ee',
    ];

    public function run()
    {
        foreach ($this->users as $user) {
            \DB::table('users')->insert([
                'username' => $user,
                'email' => $user . '@' . $user . '.com',
                'is_activity' => 1,
                'password' => \Hash::make('aaaaaa'),
            ]);
        }
    }
}
