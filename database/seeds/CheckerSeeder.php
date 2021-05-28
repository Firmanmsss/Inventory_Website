<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CheckerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('checkers')->insert([
            'name'       => 'Firman',
            'posisi'     => 'Chceker PO',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);
    }
}
