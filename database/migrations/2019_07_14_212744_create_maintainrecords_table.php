<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMaintainrecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('maintainrecords', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('sohead_id')->unsigned();
            $table->integer('seq');
            $table->date('raisedate');
            $table->string('descrip');
            $table->string('handler')->nullable();
            $table->date('handlerdate')->nullable();
            $table->string('handlemethod')->nullable();
            $table->string('result')->nullable();
            $table->string('remark')->nullable();

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
        Schema::dropIfExists('maintainrecords');
    }
}
