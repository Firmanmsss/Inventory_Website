<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PartNameSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('part__names')->insert([
            'id_cust'    => '1',
            'name'       => 'firman',
            'satuan'     => 'org',
            'std_qty'    => '1',
            'stok'       => '1',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);
    }
}
