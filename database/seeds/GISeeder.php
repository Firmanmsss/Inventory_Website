<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GISeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('gi_detail')->insert([
            'id_gi'       => '1',
            'id_buyer'    => '1',
            'id_partname' => 'PO123456789',
            'price'       => '25000',
            'qty'         => '4',
            'total'       => '100000',
            'created_at'  => \Carbon\Carbon::now(),
            'updated_at'  => \Carbon\Carbon::now(),
        ]);
    }
}
