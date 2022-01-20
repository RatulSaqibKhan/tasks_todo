<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $userRoles = ['Super Admin', 'Admin', 'User'];

        $roles = collect($userRoles)->map(function($item) {
            return [
                'name' => $item,
                'slug' => Str::of($item)->slug('-'),
                'created_at' => now(),
                'updated_at' => now(),
            ];
        })->toArray();
        
        DB::statement("SET FOREIGN_KEY_CHECKS=0;");
        DB::table('roles')->truncate();
        DB::table('roles')->insert($roles);
        DB::statement("SET FOREIGN_KEY_CHECKS=1;");
    }
}
