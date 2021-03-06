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
            'id_buyer'    => '1',
            'id_cust'     => '1',
            'no_po_buyer' => 'PO123456789',
            'checker'     => 'firman',
            'pic'         => 'feri',
            'location'    => 'A001',
            'destination' => 'Toko Jakarta, JakTim',
            'created_at'  => \Carbon\Carbon::now(),
            'updated_at'  => \Carbon\Carbon::now(),
        ]);
    }
}
