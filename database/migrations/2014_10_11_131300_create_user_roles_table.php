<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /* Կարգավիճակ */
        Schema::create('user_roles', function (Blueprint $table) {
            $table->id();
            $table->string('title_am');
            $table->string('title_en');
            $table->string('title_ru');
            $table->text('desc_am');
            $table->text('desc_en');
            $table->text('desc_ru');
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
        Schema::dropIfExists('user_roles');
    }
}
