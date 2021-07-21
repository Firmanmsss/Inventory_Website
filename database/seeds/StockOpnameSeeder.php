<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StockOpnameSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('stock_opnames')->insert([
            'keterangan' => 'SO bulan juli 2021 oleh firman',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);
    }
}
