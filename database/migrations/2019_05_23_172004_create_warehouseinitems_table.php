<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWarehouseinitemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('warehouseinitems', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('warehouseinhead_id')->unique();
            $table->integer('material_id')->unique();
            $table->decimal('quantity')->nullable();;
            $table->decimal('unitprice')->nullable();;
            $table->decimal('amount')->nullable();;
            $table->decimal('taxrate')->nullable();;
            $table->string('remark')->nullable();;
            $table->timestamps();

            $table->foreign('material_id')->references('id')->on('materials');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('warehouseinitems');
    }
}
