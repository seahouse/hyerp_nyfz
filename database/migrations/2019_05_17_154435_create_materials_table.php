<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMaterialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('materials', function (Blueprint $table) {
            $table->increments('id');

            $table->string('number')->unique();
            $table->string('name')->nullable();
            $table->integer('material_cat_id')->nullable();
            $table->string('note')->nullable();
            $table->timestamps();

            $table->foreign('material_cat_id')->references('id')->on('material_cats');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('materials');
    }
}
