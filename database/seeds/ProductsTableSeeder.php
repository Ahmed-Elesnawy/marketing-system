<?php

use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
    */
    public function run()
    {
        \App\Product::create([
            'name'        => 'قميص رجالي',
            'code'        => '0112',
            'price'       => 180.00,
            'commission'  => 24,
            'stock'       => 150,
            'desc'        => 'lorem ipsum',
            'image'       => 'products/default.jpg',
            'category_id' =>  1,
        ]);
    }
}
