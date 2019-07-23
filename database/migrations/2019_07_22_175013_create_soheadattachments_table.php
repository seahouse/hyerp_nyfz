<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSoheadattachmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('soheadattachments', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('sohead_id');
            $table->string('type')->nullable();             // 文件: file, 图片: image,
            $table->string('filename')->nullable();         // 文件原名称
            $table->string('path')->nullable();

            $table->timestamps();

            $table->foreign('sohead_id')->references('id')->on('soheads')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('soheadattachments');
    }
}
