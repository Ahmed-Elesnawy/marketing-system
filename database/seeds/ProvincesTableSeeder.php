<?php

use Illuminate\Database\Seeder;

class ProvincesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Province::create([
            'name' => 'الدقهلية',
            'shipping_price' => 50.00,
        ]);
    }
}
