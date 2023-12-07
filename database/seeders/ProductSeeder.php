<?php

namespace Database\Seeders;

use DateTime;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('products')->insert([
            [
                'product_name' => 'Giày 1',
                'image' => '1.png',
                'description'=>'Giày đẹp lắm',
                'export_price' => 1000000,
                'created_at' => new DateTime(),
            ],
            [
                'product_name' => 'Giày 2',
                'image' => '1.png',
                'description'=>'Giày đẹp lắm',
                'export_price' => 1200000,
                'created_at' => new DateTime(),
            ],
        ]);
    }
}
