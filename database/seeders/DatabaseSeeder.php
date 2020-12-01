<?php

namespace Database\Seeders;

use App\Models\CommonlistModel;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
//        User::factory()->times(300)->create();
        $this->call([
            AdminSeeder::class,
            UserSeeder::class,
            SystemSeeder::class,
            CommonlistSeeder::class,
        ]);
    }
}
