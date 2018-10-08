<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGeoCityTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('geo_city', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('country_id')->index('country_id');
            $table->integer('region_id')->index('region_id');
            $table->string('name_ru', 50)->index('name_ru');
            $table->string('name_en', 50)->index('name_en');
            $table->integer('sort')->default(0)->index('sort');
          });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('geo_city');
    }
}
