<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStreetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /* Փողոցներ */
        Schema::create('streets', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('region_id')->default(\App\Models\Region::Yerevan_ID);
            $table->foreign('region_id')
                ->references('id')->on('regions')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->unsignedBigInteger('city_id')->nullable();
            $table->foreign('city_id')
                ->references('id')->on('cities')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->unsignedBigInteger('district_id')->nullable();
            $table->foreign('district_id')
                ->references('id')->on('districts')
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
        Schema::dropIfExists('streets');
    }
}
