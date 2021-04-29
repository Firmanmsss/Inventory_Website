<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PickingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('pickings')->insert([
            'id_good_issue' => '1',
            'qty' => '10',
            'location' => 'A001',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);
    }
}
