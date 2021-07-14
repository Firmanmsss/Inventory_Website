<?php

use App\Checker;
use App\PurchaseOrder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(CheckerSeeder::class);
        $this->call(CustomerSeeder::class);
        $this->call(GoodIssueSeeder::class);
        $this->call(GoodReceiveSeeder::class);
        $this->call(ModulesSeeder::class);
        $this->call(PartNameSeeder::class);
        $this->call(PersonInCSeeder::class);
        $this->call(RolesSeeder::class);
        $this->call(SatuanSeeder::class);
        $this->call(PackingSeeder::class);
        $this->call(PickingSeeder::class);
        $this->call(TruckingSeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(LocationSeeder::class);
        $this->call(PurchaseOrderSeeder::class);
        $this->call(PurchaseDetailSeeder::class);
        $this->call(BuyerSeeder::class);
        $this->call(GRDetailSeeder::class);
    }
}
