<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PurchaseDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('purchase_details')->insert([
            'nomor_po'    => 'PO/INV/1',
            'id_partname' => '1',
            'price'       => '5500.50',
            'qty'         => '2.5',
            'total'       => '25500.75',
            'created_at'  => \Carbon\Carbon::now(),
            'updated_at'  => \Carbon\Carbon::now(),
        ]);
    }
}
