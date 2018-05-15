<?php

use Illuminate\Database\Seeder;

class WordTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
		DB::table('words')->insert([
            'word' => 'Wolf', 'category_id' => 1, 'description' => 'Eat lambs..'
        ]);
		DB::table('words')->insert([
            'word' => 'Lamb', 'category_id' => 1, 'description' => 'Food for peoples and wolfs..'
        ]);
		DB::table('words')->insert([
            'word' => 'Bulgaria', 'category_id' => 2, 'description' => 'East European country'
        ]);
		DB::table('words')->insert([
            'word' => 'Romania', 'category_id' => 2, 'description' => 'East European country'
        ]);
		DB::table('words')->insert([
            'word' => 'Spain', 'category_id' => 2, 'description' => 'Mediterranean country'
        ]);
		DB::table('words')->insert([
            'word' => 'Italy', 'category_id' => 2, 'description' => 'Mediterranean country'
        ]);
		DB::table('words')->insert([
            'word' => 'Nivea', 'category_id' => 3, 'description' => 'Cosmetics company'
        ]);
		DB::table('words')->insert([
            'word' => 'Volkswagen', 'category_id' => 3, 'description' => 'Auto mobile manufacturer'
        ]);
		DB::table('words')->insert([
            'word' => 'Unity', 'category_id' => 3, 'description' => 'Games engine'
        ]);
    }
}
