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
            $table->string('id_buyer');
            $table->string('id_cust');
            $table->string('no_po_buyer')->nullable();
            $table->string('checker');
            $table->string('pic');
            $table->string('location');
            $table->text('destination');
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
