<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnnouncementAdditionalInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('announcement_additional_infos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('announcement_id')->nullable();
            $table->foreign('announcement_id')
                ->references('id')->on('announcements')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->unsignedBigInteger('additional_info_id')->nullable();
            $table->foreign('additional_info_id')
                ->references('id')->on('additional_infos')
                ->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('announcement_additional_infos');
    }
}
