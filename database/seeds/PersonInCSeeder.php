<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PersonInCSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('person_in_c_s')->insert([
            'name'       => 'firman',
            'posisi'     => 'tester',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);
    }
}
