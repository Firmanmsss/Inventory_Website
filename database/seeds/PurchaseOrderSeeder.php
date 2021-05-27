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
            'nomor_po' => '1',
            'created_at'  => \Carbon\Carbon::now(),
            'updated_at'  => \Carbon\Carbon::now(),
        ]);
    }
}