<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnnouncementFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('announcement_files', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('announcement_id');
            $table->foreign('announcement_id')
                ->references('id')->on('announcements')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->tinyInteger('is_main')->default(0);
            $table->string('path');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('announcement_files');
    }
}
