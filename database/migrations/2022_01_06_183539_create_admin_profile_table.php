<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminProfileTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_profile', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('admin_id');
            $table->foreign('admin_id')
                ->references('id')->on('admins')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->string('gender')->nullable();
            $table->string('birthdate')->nullable();
            $table->string('avatar')->nullable();
            $table->string('phone')->nullable();
            $table->string('viber')->nullable();
            $table->string('whatsapp')->nullable();
            $table->string('telegram')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admin_profile');
    }
}
