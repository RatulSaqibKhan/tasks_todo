<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserRoleMappingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user_role_mappings = [
            [
                'user_id' => 1,
                'role_id' => 1,
                'created_by' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 2,
                'role_id' => 2,
                'created_by' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 3,
                'role_id' => 3,
                'created_by' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        DB::statement("SET FOREIGN_KEY_CHECKS=0;");
        DB::table('user_role_mappings')->truncate();
        DB::table('user_role_mappings')->insert($user_role_mappings);
        DB::statement("SET FOREIGN_KEY_CHECKS=1;");
    }
}
