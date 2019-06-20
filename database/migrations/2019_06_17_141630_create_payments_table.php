<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('pohead_id');
            $table->decimal('amount');
            $table->date('paydate');
            $table->integer('operator_id');
            $table->string('remark')->nullable();
            $table->string('paymethod');

            $table->timestamps();

            $table->foreign('pohead_id')->references('id')->on('poheads');
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
        Schema::dropIfExists('payments');
    }
}
