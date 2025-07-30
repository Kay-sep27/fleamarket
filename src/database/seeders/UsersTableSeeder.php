<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->insert([
            [
                'name'              => 'Alice Tanaka',
                'email'             => 'alice@example.com',
                'email_verified_at' => now(),
                'password'          => Hash::make('password'),
                'profile_image'     => null,
                'zip'               => '100-0001',
                'address'           => '東京都千代田区千代田1-1',
                'building'          => '皇居前ビル',
                'remember_token'    => Str::random(10),
                'created_at'        => now(),
                'updated_at'        => now(),
            ],
            [
                'name'              => 'Bob Suzuki',
                'email'             => 'bob@example.com',
                'email_verified_at' => now(),
                'password'          => Hash::make('password'),
                'profile_image'     => null,
                'zip'               => '150-0001',
                'address'           => '東京都渋谷区神南1-19-11',
                'building'          => 'パークビル',
                'remember_token'    => Str::random(10),
                'created_at'        => now(),
                'updated_at'        => now(),
            ],
            [
                'name'              => 'Carol Yamamoto',
                'email'             => 'carol@example.com',
                'email_verified_at' => now(),
                'password'          => Hash::make('password'),
                'profile_image'     => null,
                'zip'               => '530-0001',
                'address'           => '大阪府大阪市北区梅田1-1-3',
                'building'          => '大阪駅前ビル',
                'remember_token'    => Str::random(10),
                'created_at'        => now(),
                'updated_at'        => now(),
            ],
        ]);
    }
}