<?php

use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([
            'name' => str_random(10),
            'description' => str_random(10),
            'size' => 'M',
            'image'=> str_random(10),
            'category_id'=> '1',
        ]);
        DB::table('products')->insert([
            'name' => str_random(10),
            'description' => str_random(10),
            'size' => 'M',
            'image'=> str_random(10),
            'category_id'=> '1',
        ]);
        DB::table('products')->insert([
            'name' => str_random(10),
            'description' => str_random(10),
            'size' => 'M',
            'image'=> str_random(10),
            'category_id'=> '2',
        ]);
    }
}
