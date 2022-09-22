<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('product_categories')->insert([
            [
                'name' => 'Bilgisayar',
                'parent_id' => 0,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'Telefon',
                'parent_id' => 0,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'Laptop',
                'parent_id' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'Masaüstü',
                'parent_id' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'iPhone',
                'parent_id' => 2,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'Android',
                'parent_id' => 2,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]
        ]);

        DB::table('products')->insert([
            [
                'name' => 'Hp Omen',
                'desc' => 'Hp Laptop',
                'filepath' => 'hp.png',
                'product_category_id' => 3,
                'price' => 1500,
                'stock' => 3,
                'rating' => 4,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'Asus',
                'desc' => 'Asus Laptop',
                'filepath' => 'asus.png',
                'product_category_id' => 3,
                'price' => 1500,
                'stock' => 3,
                'rating' => 3,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'Casper',
                'desc' => 'Casper Laptop',
                'filepath' => 'casper.png',
                'product_category_id' => '3',
                'price' => 1500,
                'stock' => 3,
                'rating' => 2,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],

            [
                'name' => 'Masaüstü Set 1',
                'desc' => 'Nvdia gtx 1650ti, 8 gb ram, 512 gb ssd, i7 3.4 ghz',
                'filepath' => 'masaustu1.png',
                'product_category_id' => '4',
                'price' => 1500,
                'stock' => 3,
                'rating' => 5,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'Masaüstü Set 2',
                'desc' => 'Nvdia gtx 1660s, 8 gb ram, 1 tb ssd, i5 3.5 ghz',
                'filepath' => 'masaustu2.png',
                'product_category_id' => '4',
                'price' => 1500,
                'stock' => 3,
                'rating' => 3,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'Masaüstü Set 3',
                'desc' => 'Nvdia gtx 3050ti, 16 gb ram, 1 tb ssd, i7 4.1 ghz',
                'filepath' => 'masaustu3.png',
                'product_category_id' => '4',
                'price' => 1500,
                'stock' => 3,
                'rating' => 4,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]
        ]);
    }
}
