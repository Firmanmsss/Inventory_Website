<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGiDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gi_detail', function (Blueprint $table) {
            $table->id();
            $table->string('id_gi');
            $table->string('id_buyer');
            $table->string('id_partname');
            $table->double('price', 10, 2);
            $table->double('qty', 10, 2);
            $table->double('total', 10, 2);
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
        Schema::dropIfExists('gi_detail');
    }
}
