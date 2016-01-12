<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemprices extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('itemprices', function (Blueprint $table) {
            $table->increments('id');
            $table->string('classid');
            $table->string('itemcode');
            $table->decimal('aedprice',8,2);
            $table->decimal('usdprice',8,2);
            $table->decimal('lastaedprice',8,2);
            $table->decimal('lastusdprice',8,2);
            $table->integer('ispromo');
            $table->decimal('promodisc',8,2);
            $table->string('updatedby');
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
         Schema::drop('itemprices');
    }
}
