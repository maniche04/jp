<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStocklevelTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('itemstocks', function (Blueprint $table) {
            $table->increments('id');
            $table->string('itemcode');
            $table->double('currstock',8,2);
            $table->double('laststock',8,2);
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
        Schema::drop('itemstocks');
    }
}
