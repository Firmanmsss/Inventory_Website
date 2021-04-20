<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGoodReceivesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('good_receives', function (Blueprint $table) {
            $table->id();
            $table->string('id_cust');
            $table->string('id_partname');
            $table->dateTime('tanggal');
            $table->string('checker');
            $table->string('pic');
            $table->double('qty_in',10,2);
            $table->string('location');
            $table->double('qty_loc',10,2);
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
        Schema::dropIfExists('good_receives');
    }
}
