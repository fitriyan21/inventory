<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignkeyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function ($table) {
            $table->foreign('category_id')->references('id')->on('categories');
        });

        Schema::table('incoming_goods', function ($table) {
            $table->foreign('supplier_id')->references('id')->on('suppliers');
            $table->foreign('user_id')->references('id')->on('users');
        });

        Schema::table('incoming_goods_details', function ($table) {
            $table->foreign('incoming_goods_id')->references('id')->on('incoming_goods')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products');
        });

        Schema::table('outcoming_goods', function ($table) {
            $table->foreign('customer_id')->references('id')->on('customers');
            $table->foreign('user_id')->references('id')->on('users');
        });

        Schema::table('outcoming_goods_details', function ($table) {
            $table->foreign('outcoming_goods_id')->references('id')->on('outcoming_goods')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products');
        });

        Schema::table('inventory_taking', function ($table) {
            $table->foreign('user_id')->references('id')->on('users');
        });

        Schema::table('inventory_taking_details', function ($table) {
            $table->foreign('inventory_taking_id')->references('id')->on('inventory_taking')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function ($table) {
            $table->dropForeign(['category_id']);
        });

        Schema::table('incoming_goods', function ($table) {
            $table->dropForeign(['supplier_id']);
            $table->dropForeign(['user_id']);
        });

        Schema::table('incoming_goods_details', function ($table) {
            $table->dropForeign(['incoming_goods_id']);
            $table->dropForeign(['product_id']);
        });

        Schema::table('outcoming_goods', function ($table) {
            $table->dropForeign(['customer_id']);
            $table->dropForeign(['user_id']);
        });

        Schema::table('outcoming_goods_details', function ($table) {
            $table->dropForeign(['outcoming_goods_id']);
            $table->dropForeign(['product_id']);
        });

        Schema::table('inventory_taking', function ($table) {
            $table->dropForeign(['user_id']);
        });

        Schema::table('inventory_taking_details', function ($table) {
            $table->dropForeign(['inventory_taking_id']);
            $table->dropForeign(['product_id']);
        });
    }
}
