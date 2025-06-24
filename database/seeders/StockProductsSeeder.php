<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\StockProduct;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StockProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = Product::all();
        $sizes = [60, 250, 500, 1000];


        foreach ($products as $product) {
            foreach ($sizes as $size) {
                StockProduct::factory()->create([
                    'product_id' => $product->id,
                    'size' => $size,
                ]);
            }
        }
    }
}
