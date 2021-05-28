<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([
            'nama_product'=> 'GoodDay Cappucino',
            'harga_product' => 10000,
            'desc_product' => 'Kopi Sehat',
            'pic_product' => 'This Picture',
            'category_id' => 3
        ]);

        DB::table('products')->insert([
            'nama_product'=> 'Green Apple',
            'harga_product' => 5000,
            'desc_product' => 'Tidak Mahal',
            'pic_product' => 'Gambar ini',
            'category_id' => 1
        ]);

        DB::table('products')->insert([
            'nama_product'=> 'Daging Sapiiiii',
            'harga_product' => 45000,
            'desc_product' => 'Makanan Mahal',
            'pic_product' => 'Picture',
            'category_id' => 2
        ]);
    }
}
