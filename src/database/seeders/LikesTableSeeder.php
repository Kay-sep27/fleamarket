<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LikesTableSeeder extends Seeder
{
    public function run()
    {
        $now = now();

        DB::table('likes')->insert([
            ['user_id' => 1, 'item_id' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['user_id' => 2, 'item_id' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['user_id' => 3, 'item_id' => 2, 'created_at' => $now, 'updated_at' => $now],
            ['user_id' => 1, 'item_id' => 5, 'created_at' => $now, 'updated_at' => $now],
        ]);
    }
}