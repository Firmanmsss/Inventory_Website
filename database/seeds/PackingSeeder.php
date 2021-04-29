<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PackingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('packings')->insert([
            'id_picking'  => '1',
            'from'        => 'Bogor',
            'destination' => 'Jakarta',
            'tanggal'     => '2021-04-27',
            'total_qty'   => '50',
            'created_at'  => \Carbon\Carbon::now(),
            'updated_at'  => \Carbon\Carbon::now(),
        ]);
    }
}
