<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StockODetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('stock_opdetail')->insert([
            'id_so'             => '1',
            'id_partname'       => '1',
            'qty_sistem'        => '10',
            'qty_fisik'         => '12',
            'total_qty_selisih' => '-2',
            'created_at'        => \Carbon\Carbon::now(),
            'updated_at'        => \Carbon\Carbon::now(),
        ]);
    }
}
