<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWarehouseoutitemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('warehouseoutitems', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('warehouseouthead_id');
            $table->integer('material_id');
            $table->decimal('quantity')->nullable();
            $table->integer('sohead_id')->nullable();
            $table->string('remark')->nullable();
            $table->timestamps();

            $table->foreign('material_id')->references('id')->on('materials');
            $table->foreign('sohead_id')->references('id')->on('soheads');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('warehouseoutitems');
    }
}
