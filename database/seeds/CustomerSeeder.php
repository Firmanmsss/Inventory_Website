<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('customers')->insert([
            'name'       => 'Toko Hype.Mocha',
            'no_telp'    => '081234567898',
            'alamat'     => 'Tangerang',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);
    }
}
