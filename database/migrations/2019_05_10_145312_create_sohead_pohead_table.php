<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSoheadPoheadTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sohead_pohead', function (Blueprint $table) {
            $table->integer('sohead_id')->unsigned();
            $table->integer('pohead_id')->unsigned();

            $table->foreign('sohead_id')->references('id')->on('soheads');
            $table->foreign('pohead_id')->references('id')->on('poheads');

            $table->timestamps();

            $table->primary(['sohead_id', 'pohead_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sohead_pohead');
    }
}
