<?php

use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            'name' => 'catgory 1',
        ]);
        DB::table('categories')->insert([
            'name' => 'catgory 2',
        ]);        
    }
}
