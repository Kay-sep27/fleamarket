<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ItemsTableSeeder extends Seeder
{
    public function run()
    {
        $now = now();

        DB::table('items')->insert([
            [
                'user_id'     => 1,
                'name'        => '腕時計',
                'brand'       => 'Rolax',
                'description' => 'スタイリッシュなデザインのメンズ腕時計',
                'price'       => 15000,
                'img_url'     => 'https://coachtech-matter.s3.ap-northeast-1.amazonaws.com/image/Armani+Mens+Clock.jpg',
                'condition'   => '良好',
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            [
                'user_id'     => 2,
                'name'        => 'HDD',
                'brand'       => '西芝',
                'description' => '高速で信頼性の高いハードディスク',
                'price'       => 5000,
                'img_url'     => 'https://coachtech-matter.s3.ap-northeast-1.amazonaws.com/image/HDD+Hard+Disk.jpg',
                'condition'   => '目立った傷や汚れなし',
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            [
                'user_id'     => 3,
                'name'        => '玉ねぎ3束',
                'brand'       => null,
                'description' => '新鮮な玉ねぎ3束のセット',
                'price'       => 300,
                'img_url'     => 'https://coachtech-matter.s3.ap-northeast-1.amazonaws.com/image/iLoveIMG+d.jpg',
                'condition'   => 'やや傷や汚れあり',
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            [
                'user_id'     => 1,
                'name'        => '革靴',
                'brand'       => null,
                'description' => 'クラシックなデザインの革靴',
                'price'       => 4000,
                'img_url'     => 'https://coachtech-matter.s3.ap-northeast-1.amazonaws.com/image/Leather+Shoes+Product+Photo.jpg',
                'condition'   => '状態が悪い',
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            [
                'user_id'     => 2,
                'name'        => 'ノートPC',
                'brand'       => null,
                'description' => '高性能なノートパソコン',
                'price'       => 45000,
                'img_url'     => 'https://coachtech-matter.s3.ap-northeast-1.amazonaws.com/image/Living+Room+Laptop.jpg',
                'condition'   => '良好',
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            [
                'user_id'     => 3,
                'name'        => 'マイク',
                'brand'       => null,
                'description' => '高音質のレコーディング用マイク',
                'price'       => 8000,
                'img_url'     => 'https://coachtech-matter.s3.ap-northeast-1.amazonaws.com/image/Music+Mic+4632231.jpg',
                'condition'   => '目立った傷や汚れなし',
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            [
                'user_id'     => 1,
                'name'        => 'ショルダーバッグ',
                'brand'       => null,
                'description' => 'おしゃれなショルダーバッグ',
                'price'       => 3500,
                'img_url'     => 'https://coachtech-matter.s3.ap-northeast-1.amazonaws.com/image/Purse+fashion+pocket.jpg',
                'condition'   => 'やや傷や汚れあり',
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            [
                'user_id'     => 2,
                'name'        => 'タンブラー',
                'brand'       => null,
                'description' => '使いやすいタンブラー',
                'price'       => 500,
                'img_url'     => 'https://coachtech-matter.s3.ap-northeast-1.amazonaws.com/image/Tumbler+souvenir.jpg',
                'condition'   => '状態が悪い',
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            [
                'user_id'     => 3,
                'name'        => 'コーヒーミル',
                'brand'       => 'Starbacks',
                'description' => '手動のコーヒーミル',
                'price'       => 4000,
                'img_url'     => 'https://coachtech-matter.s3.ap-northeast-1.amazonaws.com/image/Waitress+with+Coffee+Grinder.jpg',
                'condition'   => '良好',
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            [
                'user_id'     => 1,
                'name'        => 'メイクセット',
                'brand'       => null,
                'description' => '便利なメイクアップセット',
                'price'       => 2500,
                'img_url'     => 'https://coachtech-matter.s3.ap-northeast-1.amazonaws.com/image/%E5%A4%96%E5%87%BA%E3%83%A1%E3%82%A4%E3%82%AF%E3%82%A2%E3%83%83%E3%83%95%E3%82%9A%E3%82%BB%E3%83%83%E3%83%88.jpg',
                'condition'   => '目立った傷や汚れなし',
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
        ]);
    }
}