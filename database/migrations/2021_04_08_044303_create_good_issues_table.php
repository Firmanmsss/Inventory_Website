<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGoodIssuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('good_issues', function (Blueprint $table) {
            $table->id();
            $table->string('id_cust');
            $table->string('id_partname');
            $table->dateTime('tanggal');
            $table->string('no_po_cust');
            $table->string('checker');
            $table->string('pic');
            $table->string('destination');
            $table->double('qty',10,2);
            $table->string('location');
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
        Schema::dropIfExists('good_issues');
    }
}
