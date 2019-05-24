<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWarehouseinvsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('warehouseinvs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('material_id');
            $table->integer('warehouse_id');
            $table->decimal('quantity')->nullable();
            $table->text('remark')->nullable();

            $table->timestamps();

            $table->unique(['material_id','warehouse_id']);
            $table->foreign('material_id')->references('id')->on('materials');
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
        Schema::dropIfExists('warehouseinvs');
    }
}
