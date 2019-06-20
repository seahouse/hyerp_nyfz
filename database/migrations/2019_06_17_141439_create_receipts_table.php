<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReceiptsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('receipts', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('sohead_id');
            $table->decimal('amount');
            $table->date('receivedate');
            $table->integer('operator_id');
            $table->string('remark')->nullable();
            $table->string('paymethod');

            $table->timestamps();

            $table->foreign('sohead_id')->references('id')->on('soheads');
            $table->foreign('operator_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('receipts');
    }
}
