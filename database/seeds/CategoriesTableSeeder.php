<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            'name' => 'Basics',
            'active' => true,
        ]);

        DB::table('categories')->insert([
            'name' => 'Mobile',
            'active' => true,
        ]);
        
        DB::table('categories')->insert([
            'name' => 'Account',
            'active' => true,
        ]);
        
        DB::table('categories')->insert([
            'name' => 'Payments',
            'active' => true,
        ]);
        
        DB::table('categories')->insert([
            'name' => 'Privacy',
            'active' => true,
        ]);
        
        DB::table('categories')->insert([
            'name' => 'Delivery',
            'active' => true,
        ]);
    }
}
