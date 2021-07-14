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
            'id_po'      => '1',
            'id_cust'    => '1',
            'nomor_po'   => 'PO/INV/101',
            'checker'    => 'firman',
            'pic'        => 'fendi',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);
    }
}
