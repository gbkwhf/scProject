<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateYsStoreGoodsClassTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ys_store_goods_class', function (Blueprint $table) {
        	$table->increments('id');        	 
            $table->string('name')->comment="分类名";
            $table->integer('store_id')->comment="供应商id";
            $table->integer('sort')->default(255)->comment="排序";
         
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('ys_store_goods_class');    	
    }
}
