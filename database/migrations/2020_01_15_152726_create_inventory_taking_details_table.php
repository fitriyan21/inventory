<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInventoryTakingDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventory_taking_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('inventory_taking_id')->unsigned();
            $table->bigInteger('product_id')->unsigned();
            $table->integer('initial_qty');
            $table->integer('final_qty');
            $table->integer('difference');
            $table->string('note');
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
        Schema::dropIfExists('inventory_taking_details');
    }
}
