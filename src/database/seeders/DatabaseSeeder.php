<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(): void
{
    \App\Models\Category::factory(5)->create();
    \App\Models\Contact::factory(35)->create();
}
}
