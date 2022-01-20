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
            [
                'name' => "System Admin",
                'email' => "system-admin@todo.com",
                'designation' => "System Admin",
                'phone_no' => "098765435",
                'address' => "Dhaka, Bangladesh",
                'password' => \bcrypt('123456'),
                'created_by' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => "Admin",
                'email' => "admin@todo.com",
                'designation' => "Admin",
                'phone_no' => "098765435",
                'address' => "Dhaka, Bangladesh",
                'password' => \bcrypt('123456'),
                'created_by' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => "User",
                'email' => "user@todo.com",
                'designation' => "User",
                'phone_no' => "0987654353",
                'address' => "Gazipur, Bangladesh",
                'password' => \bcrypt('123456'),
                'created_by' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        DB::statement("SET FOREIGN_KEY_CHECKS=0;");
        DB::table('users')->truncate();
        DB::table('users')->insert($users);
        DB::statement("SET FOREIGN_KEY_CHECKS=1;");
    }
}
