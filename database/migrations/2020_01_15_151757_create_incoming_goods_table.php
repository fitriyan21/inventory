<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIncomingGoodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('incoming_goods', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('invoice');
            $table->bigInteger('supplier_id')->unsigned();
            $table->bigInteger('user_id')->unsigned();
            $table->date('date');
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
        Schema::dropIfExists('incoming_goods');
    }
}
