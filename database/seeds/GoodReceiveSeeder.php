<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GoodReceiveSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('good_receives')->insert([
            'id_cust'     => '1',
            'id_partname' => '1',
            'tanggal'     => '2021-04-27',
            'checker'     => 'firman',
            'pic'         => 'fendi',
            'qty_in'      => '50',
            'location'    => 'A001',
            'qty_loc'     => '10',
            'created_at'  => \Carbon\Carbon::now(),
            'updated_at'  => \Carbon\Carbon::now(),
        ]);
    }
}
