<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGeoRegionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('geo_region', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('country_id')->index('id_country');
            $table->string('name_ru',50)->index('name_ru');
            $table->string('name_en',50)->index('name_en');
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
        Schema::dropIfExists('geo_region');
    }
}
