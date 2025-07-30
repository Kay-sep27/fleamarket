<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CommentsTableSeeder extends Seeder
{
    public function run()
    {
        $now = now();

        DB::table('comments')->insert([
            [
                'user_id'    => 2,
                'item_id'    => 1,
                'comment'    => 'この腕時計、デザインがかっこいいですね！',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'user_id'    => 1,
                'item_id'    => 2,
                'comment'    => 'このHDD、まだ在庫ありますか？',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'user_id'    => 3,
                'item_id'    => 5,
                'comment'    => 'ノートPCの動作状態は良好ですか？',
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);
    }
}