<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        Product::truncate();

        Product::insert([
            [
                'name' => 'Nastar',
                'category' => 'bakery',
                'price' => 50000,
                'description' => 'Kue nastar premium',
                'image_url' => null,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Brownies',
                'category' => 'bakery',
                'price' => 60000,
                'description' => 'Brownies coklat',
                'image_url' => null,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Paket Nasi Box A',
                'category' => 'catering',
                'price' => 25000,
                'description' => 'Nasi + ayam + sayur + sambal',
                'image_url' => null,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}