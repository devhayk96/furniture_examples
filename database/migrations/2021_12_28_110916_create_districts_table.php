<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDistrictsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /* Վարչական շրջաններ կամ համայքներ */
        Schema::create('districts', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('region_id')->nullable();
            $table->foreign('region_id')
                ->references('id')->on('regions')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->unsignedBigInteger('city_id')->nullable();
            $table->foreign('city_id')
                ->references('id')->on('cities')
                ->onUpdate('cascade')->onDelete('cascade');

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
        Schema::dropIfExists('districts');
    }
}
