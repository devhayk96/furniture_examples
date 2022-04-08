<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoryDealTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /* Գույքի գործարքի տեսակներ */
        Schema::create('category_deal_types', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('category_id');
            $table->foreign('category_id')
                ->references('id')->on('categories')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->unsignedBigInteger('deal_type_id');
            $table->foreign('deal_type_id')
                ->references('id')->on('deal_types')
                ->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('category_deal_types', function (Blueprint $table) {
            $table->dropForeign(['category_id']);
            $table->dropForeign(['deal_type_id']);
        });
        Schema::dropIfExists('category_deal_types');
    }
}
