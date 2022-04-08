<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBuildingFloorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /* Շենքի հարկ/հարկայնություն */
        Schema::create('building_floors', function (Blueprint $table) {
            $table->id();
            $table->string('title_am');
            $table->string('title_en');
            $table->string('title_ru');
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
        Schema::dropIfExists('building_floors');
    }
}
