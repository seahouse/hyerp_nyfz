<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWarehouseinheadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wareshouseinheads', function (Blueprint $table) {
            $table->increments('id');

            $table->string('number')->unique();
            $table->datetime('date')->nullable();
            $table->string('type')->nullable();
            $table->integer('pohead_id')->nullable();
            $table->integer('warehouse_id')->nullable();
            $table->integer('vendor_id')->nullable();
            $table->string('remark')->nullable();

            $table->timestamps();

            $table->foreign('warehouse_id')->references('id')->on('warehouses');
            $table->foreign('pohead_id')->references('id')->on('poheads');
            $table->foreign('vendor_id')->references('id')->on('vendors');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('wareshouseinheads');
    }
}
