<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLinksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('links', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('url')->nullable();
            $table->string('email')->nullable();
            $table->string('reciprocal_link')->nullable();
            $table->text('description');
            $table->text('keywords')->nullable();
            $table->text('full_description');
            $table->text('htmlcode_banner')->nullable();
            $table->integer('catalog_id')->index('catalog_id');
            $table->string('status', 10);
            $table->string('token', 50);
            $table->boolean('check_link');
            $table->integer('views')->default(0);
            $table->text('comment')->nullable();
            $table->dateTime('time_check')->default('0000-00-00 00:00:00');
            $table->integer('number_check')->default(0);
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
        Schema::dropIfExists('links');
    }
}
