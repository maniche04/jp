<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCurrentcartTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('currentcart', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('userid');
            $table->string('itemcode');
            $table->double('selqty',15,2);
            $table->decimal('itemrate',8,2);
            $table->string('currency');
            $table->double('totalprice',20,2);
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
        Schema::drop('currentcart');
    }
}
