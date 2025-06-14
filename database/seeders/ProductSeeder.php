<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Product::create([
        'name' => 'Thức ăn cho mèo Whiskas',
        'description' => 'Thức ăn hạt khô cho mèo vị cá ngừ.',
        'price' => 120000,
        'image' => 'whiskas.png'
    ]);
    }
}
