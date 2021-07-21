<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStockOpdetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stock_opdetail', function (Blueprint $table) {
            $table->id();
            $table->string('id_so');
            $table->string('id_partname');
            $table->double('qty_sistem',20,2);
            $table->double('qty_fisik',20,2);
            $table->double('total_qty_selisih',20,2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stock_opdetail');
    }
}
