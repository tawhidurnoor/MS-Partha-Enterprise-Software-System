<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = [
            ['product_name' => 'Urea'],
            ['product_name' => 'TSP'],
            ['product_name' => 'MOP'],
            ['product_name' => 'DAP'],
        ];
        DB::table('products')->insert($products);
    }
}
