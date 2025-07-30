<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesTableSeeder extends Seeder
{
    public function run()
    {
        $now = now();

        DB::table('categories')->insert([
            ['name' => '時計',       'created_at' => $now, 'updated_at' => $now],
            ['name' => '家電',       'created_at' => $now, 'updated_at' => $now],
            ['name' => '食品',       'created_at' => $now, 'updated_at' => $now],
            ['name' => '靴',         'created_at' => $now, 'updated_at' => $now],
            ['name' => 'パソコン',   'created_at' => $now, 'updated_at' => $now],
            ['name' => 'オーディオ', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'バッグ',     'created_at' => $now, 'updated_at' => $now],
            ['name' => '生活雑貨','created_at' => $now, 'updated_at' => $now],
            ['name' => '趣味',       'created_at' => $now, 'updated_at' => $now],
            ['name' => '美容',       'created_at' => $now, 'updated_at' => $now],
        ]);
    }
}