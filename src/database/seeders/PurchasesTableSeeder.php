<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PurchasesTableSeeder extends Seeder
{
    public function run()
    {
        $now = now();

        DB::table('purchases')->insert([
            [
                'user_id'          => 2,
                'item_id'          => 4,
                'payment_method'   => 'convenience',
                'shipping_zip'     => '150-0001',
                'shipping_address' => '東京都渋谷区神南1-19-11',
                'shipping_building'=> 'パークビル',
                'created_at'       => $now,
                'updated_at'       => $now,
            ],
            [
                'user_id'          => 3,
                'item_id'          => 7,
                'payment_method'   => 'card',
                'shipping_zip'     => '100-0001',
                'shipping_address' => '東京都千代田区千代田1-1',
                'shipping_building'=> '皇居前ビル',
                'created_at'       => $now,
                'updated_at'       => $now,
            ],
        ]);
    }
}