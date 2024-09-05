<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::create([
            'name' => 'Coca Cola',
            'purchase_price' => 5000,
            'selling_price' => 7000,
            'description' => 'Minuman bersoda',
            'stock' => 100,
            'image' => 'https://www.coca-cola.co.id/content/dam/journey/id/id/private/2021/01/hero-cc-id-2021-01-01.jpg',
            'category' => 'drink',
        ]);

        Product::create([
            'name' => 'Pepsi',
            'purchase_price' => 5000,
            'selling_price' => 7000,
            'description' => 'Minuman bersoda',
            'stock' => 100,
            'image' => 'https://www.pepsi.com/sites/g/files/gmbl9u211/files/2021-01/pepsi-soft-drink-2L.png',
            'category' => 'drink',
        ]);

        Product::create([
            'name' => 'Fanta',
            'purchase_price' => 5000,
            'selling_price' => 7000,
            'description' => 'Minuman bersoda',
            'stock' => 100,
            'image' => 'https://www.coca-cola.co.id/content/dam/journey/id/id/private/2021/01/hero-cc-id-2021-01-01.jpg',
            'category' => 'drink',
        ]);

        Product::create([
            'name' => 'Burger',
            'purchase_price' => 30000,
            'selling_price' => 25000,
            'description' => 'Fast Food',
            'stock' => 1200,
            'image' => '',
            'category' => 'snack',
        ]);
    }
}
