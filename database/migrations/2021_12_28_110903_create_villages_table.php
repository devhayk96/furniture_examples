<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVillagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /* Գյուղեր */
        Schema::create('villages', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('region_id')->nullable();
            $table->foreign('region_id')
                ->references('id')->on('regions')
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
        Schema::dropIfExists('villages');
    }
}
