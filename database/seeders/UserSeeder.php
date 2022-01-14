<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            'name' => "Admin",
            'email' => "admin@todo.com",
            'password' => \bcrypt('123456'),
            'created_at' => now(),
            'updated_at' => now(),
        ];
        DB::table('users')->truncate();
        DB::table('users')->insert($users);
    }
}
