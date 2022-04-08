<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnnouncementDealTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('announcement_deal_types', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('announcement_id');
            $table->foreign('announcement_id')
                ->references('id')->on('announcements')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->unsignedBigInteger('deal_type_id');
            $table->foreign('deal_type_id')
                ->references('id')->on('deal_types')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->bigInteger('price');
            $table->string('currency')->nullable()->comment('արժույթ');
//            $table->foreign('currency_id')->references('id')->on('currencies');

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
        Schema::dropIfExists('announcement_deal_types');
    }
}
