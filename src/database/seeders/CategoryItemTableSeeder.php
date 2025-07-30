<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoryItemTableSeeder extends Seeder
{
    public function run()
    {
        $now = now();

        DB::table('category_item')->insert([
            ['item_id' => 1,  'category_id' => 1,  'created_at' => $now, 'updated_at' => $now], // 腕時計 → 時計
            ['item_id' => 2,  'category_id' => 2,  'created_at' => $now, 'updated_at' => $now], // HDD → 家電
            ['item_id' => 3,  'category_id' => 3,  'created_at' => $now, 'updated_at' => $now], // 玉ねぎ3束 → 食品
            ['item_id' => 4,  'category_id' => 4,  'created_at' => $now, 'updated_at' => $now], // 革靴 → 靴
            ['item_id' => 5,  'category_id' => 5,  'created_at' => $now, 'updated_at' => $now], // ノートPC → パソコン
            ['item_id' => 6,  'category_id' => 6,  'created_at' => $now, 'updated_at' => $now], // マイク → オーディオ
            ['item_id' => 7,  'category_id' => 7,  'created_at' => $now, 'updated_at' => $now], // ショルダーバッグ → バッグ
            ['item_id' => 8,  'category_id' => 8,  'created_at' => $now, 'updated_at' => $now], // タンブラー → 生活雑貨
            ['item_id' => 9,  'category_id' => 9,  'created_at' => $now, 'updated_at' => $now], // コーヒーミル → 趣味
            ['item_id' => 10, 'category_id' => 10, 'created_at' => $now, 'updated_at' => $now], // メイクセット → 美容
        ]);
    }
}