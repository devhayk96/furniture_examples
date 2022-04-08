<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string('icon')->nullable();
            $table->string('menu_title_am')->unique();
            $table->string('menu_title_en')->unique();
            $table->string('menu_title_ru')->unique();
            $table->string('page_title_am')->unique();
            $table->string('page_title_en')->unique();
            $table->string('page_title_ru')->unique();
            $table->longText('desc_am')->nullable();
            $table->longText('desc_en')->nullable();
            $table->longText('desc_ru')->nullable();
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
        Schema::dropIfExists('services');
    }
}
