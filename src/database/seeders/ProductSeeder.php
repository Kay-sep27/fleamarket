<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Season;

class ProductSeeder extends Seeder
{
    public function run()
    {
        // 商品データ配列（画像パス付き）
        $products = [
            [
                'name' => 'キウイ',
                'price' => 800,
                'description' => 'キウイは甘みと酸味のバランスが絶妙なフルーツです。ビタミンCなどの栄養素も豊富のため、美肌効果や疲労回復効果も期待できます。もぎたてフルーツのスムージーをお召し上がりください！',
                'seasons' => ['秋', '冬'],
                'image' => 'images/kiwi.png',
            ],
            [
                'name' => 'ストロベリー',
                'price' => 1200,
                'description' => '大人から子供まで大人気のストロベリー。当店では鮮度抜群の完熟いちごを使用しています。ビタミンCはもちろん食物繊維も豊富なため、腸内環境の改善も期待できます。もぎたてフルーツのスムージーをお召し上がりください！',
                'seasons' => ['春'],
                'image' => 'images/strawberry.png',
            ],
            [
                'name' => 'オレンジ',
                'price' => 850,
                'description' => '酸味と甘みのバランスが抜群のネーブルオレンジ。濃厚な果汁が魅力の商品です。もぎたてフルーツのスムージーをお召し上がりください！',
                'seasons' => ['冬'],
                'image' => 'images/orange.png',
            ],
            [
                'name' => 'スイカ',
                'price' => 700,
                'description' => '甘くてシャリシャリ食感が魅力のスイカ。暑い日の水分補給や熱中症予防にもおすすめ。もぎたてフルーツのスムージーをお召し上がりください！',
                'seasons' => ['夏'],
                'image' => 'images/watermelon.png',
            ],
            [
                'name' => 'ピーチ',
                'price' => 1000,
                'description' => '豊潤な香りととろけるような甘さが魅力のピーチ。生活習慣病の予防にもおすすめです。もぎたてフルーツのスムージーをお召し上がりください！',
                'seasons' => ['夏'],
                'image' => 'images/peach.png',
            ],
            [
                'name' => 'シャインマスカット',
                'price' => 1400,
                'description' => '爽やかな香りと上品な甘みが特長のシャインマスカット。疲れた脳や体のエネルギー補給にも最適。もぎたてフルーツのスムージーをお召し上がりください！',
                'seasons' => ['夏', '秋'],
                'image' => 'images/muscat.png',
            ],
            [
                'name' => 'パイナップル',
                'price' => 800,
                'description' => 'トロピカルな香りと甘酸っぱさが特徴。国産のパイナップルを使用しています。もぎたてフルーツのスムージーをお召し上がりください！',
                'seasons' => ['春', '夏'],
                'image' => 'images/pineapple.png',
            ],
            [
                'name' => 'ブドウ',
                'price' => 1100,
                'description' => '高い糖度と適度な酸味が魅力の巨峰。見た目も可愛い商品です。もぎたてフルーツのスムージーをお召し上がりください！',
                'seasons' => ['夏', '秋'],
                'image' => 'images/grapes.png',
            ],
            [
                'name' => 'バナナ',
                'price' => 600,
                'description' => '低カロリーで栄養満点。ダイエット中にもおすすめ。濃厚な甘みを存分に堪能できます。もぎたてフルーツのスムージーをお召し上がりください！',
                'seasons' => ['夏'],
                'image' => 'images/banana.png',
            ],
            [
                'name' => 'メロン',
                'price' => 900,
                'description' => 'ジューシーで品のある甘さが人気。むくみ解消効果も期待。もぎたてフルーツのスムージーをお召し上がりください！',
                'seasons' => ['春', '夏'],
                'image' => 'images/melon.png',
            ],
        ];

        // 商品ごとに保存処理
        foreach ($products as $item) {
            $product = Product::create([
                'name' => $item['name'],
                'price' => $item['price'],
                'description' => $item['description'],
                'image' => $item['image'],
            ]);

            // 季節をIDに変換して中間テーブルに追加
            $seasonIds = Season::whereIn('name', $item['seasons'])->pluck('id')->toArray();
            $product->seasons()->attach($seasonIds);
        }
    }
}