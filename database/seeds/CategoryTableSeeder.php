<?php

use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
		DB::table('categories')->insert([
            'category' => 'Animals'
        ]);
		DB::table('categories')->insert([
            'category' => 'Countries'
        ]);
		DB::table('categories')->insert([
            'category' => 'Brands'
        ]);
    }
}
