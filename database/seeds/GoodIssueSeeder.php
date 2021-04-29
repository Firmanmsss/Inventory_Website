<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GoodIssueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('good_issues')->insert([
            'id_cust'     => '1',
            'id_partname' => '1',
            'tanggal'     => '2021-04-27',
            'no_po_cust'  => 'PO123456789',
            'checker'     => 'firman',
            'pic'         => 'feri',
            'destination' => 'Toko Jakarta, JakTim',
            'qty'         => '25',
            'location'    => 'A001',
            'created_at'  => \Carbon\Carbon::now(),
            'updated_at'  => \Carbon\Carbon::now(),
        ]);
    }
}
