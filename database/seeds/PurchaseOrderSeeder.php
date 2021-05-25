<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PurchaseOrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('purchase_orders')->insert([
            'id_partname' => '1',
            'price'       => '5500.50',
            'qty'         => '2.5',
            'total'       => '25500.75',
            'created_at'  => \Carbon\Carbon::now(),
            'updated_at'  => \Carbon\Carbon::now(),
        ]);
    }
}
