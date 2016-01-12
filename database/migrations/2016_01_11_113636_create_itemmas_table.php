<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemmasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('itemmas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('itemcode')->unique();
            $table->string('itemname');
            $table->string('brand');
            $table->string('gender');
            $table->string('size');
            $table->string('type');
            $table->string('imgurl');
            $table->integer('isactive');
            $table->integer('isnew');
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
        Schema::drop('itemmas');
    }
}
