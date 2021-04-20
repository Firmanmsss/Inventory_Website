<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePartNamesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('part__names', function (Blueprint $table) {
            $table->id();
            $table->string('id_cust');
            $table->string('name');
            $table->string('satuan');
            $table->double('std_qty',10,2)->default(0.00);
            $table->double('stok',10,2)->default(0.00);
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
        Schema::dropIfExists('part__names');
    }
}
