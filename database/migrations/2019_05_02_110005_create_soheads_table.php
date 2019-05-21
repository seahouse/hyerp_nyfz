<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSoheadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('soheads', function (Blueprint $table) {
            $table->increments('id');

            $table->string('number')->unique();
            $table->string('name')->nullable();
            $table->integer('customer_id')->nullable();
            $table->date('orderdate')->nullable();
//            $table->integer('warehouse_id')->nullable();
//            $table->string('shipto')->nullable();
            $table->integer('salesmanager_id')->nullable();
//            $table->integer('term_id')->nullable();
//            $table->string('comments')->nullable();
            $table->decimal('total_amount')->nullable();
            $table->date('duedate')->nullable();
            $table->timestamps();

            $table->foreign('customer_id')->references('id')->on('customers');
            $table->foreign('salesmanager_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('soheads');
    }
}
