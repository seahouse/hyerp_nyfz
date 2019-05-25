<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWarehouseoutheadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('warehouseoutheads', function (Blueprint $table) {
            $table->increments('id');

            $table->string('number')->unique();
            $table->datetime('date')->nullable();
            $table->string('type')->nullable();
            $table->integer('warehouse_id')->nullable();
            $table->string('remark')->nullable();
            $table->timestamps();

            $table->foreign('warehouse_id')->references('id')->on('warehouses');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('warehouseoutheads');
    }
}
