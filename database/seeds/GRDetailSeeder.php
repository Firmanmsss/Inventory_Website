<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GRDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('gr_details')->insert([
            'id_gr'       => '1',
            'id_po'       => '1',
            'location'    => 'A-001',
            'created_at'  => \Carbon\Carbon::now(),
            'updated_at'  => \Carbon\Carbon::now(),
        ]);
    }
}
