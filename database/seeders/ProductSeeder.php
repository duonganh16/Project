<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run()
    {
        Product::create([
            'name' => 'Thức ăn cho chó Pedigree 3kg',
            'description' => 'Thức ăn khô dinh dưỡng cao cho chó trưởng thành.',
            'price' => 250000,
            'image' => 'pedigree.jpg',
        ]);

        Product::create([
            'name' => 'Thức ăn cho mèo Whiskas 1.5kg',
            'description' => 'Dành cho mèo lớn từ 1 tuổi trở lên.',
            'price' => 180000,
            'image' => 'whiskas.jpg',
        ]);
    }
}
