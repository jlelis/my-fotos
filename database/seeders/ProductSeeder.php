<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductPhoto;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::factory()
            ->has(ProductPhoto::factory())->count(5)
            ->create();


    }
}
