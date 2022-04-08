<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWebsiteInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('website_info', function (Blueprint $table) {
            $table->id();
            $table->string('email')->nullable();
            $table->string('address_am')->nullable();
            $table->string('address_en')->nullable();
            $table->string('address_ru')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('office_phone_number')->nullable();
            $table->json('footer_links')->nullable();
            $table->json('photo_service')->nullable();
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
        Schema::dropIfExists('website_info');
    }
}
