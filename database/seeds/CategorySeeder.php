<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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
            'category_name' => 'T-Shirt', 
            'created_at'    => \Carbon\Carbon::now(),
            'updated_at'    => \Carbon\Carbon::now(),
        ]);
    }
}
