<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\UserSeeder;
use  App\Models\Category;
use  App\Models\Store;
use  App\Models\Product;
use Illuminate\Support\Facades\Hash;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
      \App\models\Admin::factory(3)->create();
        // Store::factory(5)->create();
        // Category::factory(10)->create();
        // Product::factory(100)->create();
      //  $this->call(UserSeeder::class);
    }
}