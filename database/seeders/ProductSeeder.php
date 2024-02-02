<?php

namespace Database\Seeders;

use Faker\Provider\Lorem;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;
class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::create([
            'title' => 'Phone',
            'price' => 19.03,
            'quantity' => 3,
            'category_id' => 1,
            'brand_id' => 1,
            'description' => 'Do cupidatat ullamco est exercitation consequat anim proident ipsum veniam quis aute eu labore. Nostrud ullamco consectetur et culpa consequat elit veniam magna aliqua aute ex exercitation Lorem. Et sunt nostrud amet qui voluptate. Reprehenderit amet non velit nostrud esse eu sunt. Excepteur est consectetur Lorem veniam officia Lorem qui et aliquip sint ullamco id ad. Aute occaecat elit minim aliqua ex eu excepteur qui aliquip.',
            
        ]);
    }
}
