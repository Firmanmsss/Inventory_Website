<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TruckingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('truckings')->insert([
            'id_packing'      => '1',
            'nama_pengendara' => 'fendi',
            'plat_nomor'      => 'B 1234 ABC',
            'created_at'      => \Carbon\Carbon::now(),
            'updated_at'      => \Carbon\Carbon::now(),
        ]);
    }
}
