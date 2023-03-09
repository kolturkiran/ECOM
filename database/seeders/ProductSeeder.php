<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('products')->insert([
            [
                'name'=>'LG mobile',
                'price'=>'200',
                'description'=>'smartphone with 4GB RAM',
                'category'=>'mobile',
                'gallery'=>'https://www.gsmarena.com/lg_wing_5g-pictures-10442.php',            
            ],
            [
                'name'=>'oppo mobile',
                'price'=>'300',
                'description'=>'smartphone with 8GB RAM',
                'category'=>'mobile',
                'gallery'=>'https://cdn1.smartprix.com/rx-iuvs4uvlM-w1200-h1200/uvs4uvlM.jpg',            
            ],
            [
                'name'=>'LG TV',
                'price'=>'500',
                'description'=>'smarttv',
                'category'=>'TV',
                'gallery'=>'https://www.lg.com/levant_en/images/tvs/md06140818/gallery/TV-FHD-32-32H-LM63-B-Gallery-1100-01.jpg',            
            ],
            [
                'name'=>'Panasonic TV',
                'price'=>'550',
                'description'=>'smarttv',
                'category'=>'TV',
                'gallery'=>'https://image3.mouthshut.com/images/imagesp/926046997s.jpeg',            
            ],
    ]);
    }
}
