<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustinfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Custinfos', function (Blueprint $table) {
            $table->increments('id');

            $table->boolean('active')->nullable()->default(true);
            $table->string('number')->unique();
            $table->string('name')->nullable()->default('');
            $table->string('contact_name')->nullable();
            $table->string('comments')->nullable()->default('');

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
        Schema::dropIfExists('Custinfos');
    }
}
