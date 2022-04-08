<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnnouncementDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('announcement_details', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('announcement_id')->nullable();
            $table->foreign('announcement_id')
                ->references('id')->on('announcements')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->unsignedBigInteger('seller_status_type_id')->nullable()->comment('կարգավիճակ');
            $table->foreign('seller_status_type_id')
                ->references('id')->on('seller_status_types');

            $table->unsignedBigInteger('region_id')->nullable()->comment('մարզ');
            $table->foreign('region_id')
                ->references('id')->on('regions');

            $table->unsignedBigInteger('city_id')->nullable()->comment('քաղաք');
            $table->foreign('city_id')
                ->references('id')->on('cities');

            $table->unsignedBigInteger('village_id')->nullable()->comment('գյուղ');
            $table->foreign('village_id')
                ->references('id')->on('villages');

            $table->unsignedBigInteger('district_id')->nullable()->comment('վարչական շրջան կամ համայնք');
            $table->foreign('district_id')
                ->references('id')->on('districts');

            $table->unsignedBigInteger('street_id')->nullable()->comment('փողոց');
            $table->foreign('street_id')
                ->references('id')->on('streets');

            $table->string('building_address')->nullable()->comment('շինության հասցեն');

            $table->unsignedBigInteger('repairing_type_id')->nullable()->comment('վերանորոգման տեսակ');
            $table->foreign('repairing_type_id')
                ->references('id')->on('repairing_types');

            $table->unsignedBigInteger('building_type_id')->nullable()->comment('շինության տեսակ');
            $table->foreign('building_type_id')
                ->references('id')->on('building_types');

            $table->integer('floors_count')->nullable()->comment('հարկերի քանակ');

            $table->string('building_floor_ids')->nullable()->comment('շենքի հարկ/հարկայնություն');
//            $table->foreign('building_floor_id')
//                ->references('id')->on('building_floors');

            $table->unsignedBigInteger('commercial_area_type_id')->nullable()->comment('կոմերցիոն տարածքի տեսակ');
            $table->foreign('commercial_area_type_id')
                ->references('id')->on('commercial_area_types');

            $table->tinyInteger('first_line')->default(0)->comment('առաջին գիծ (կոմերցիոն տարածք կամ հողատարածք)');
            $table->string('building')->nullable()->comment('շենք');
            $table->string('apartment')->nullable()->comment('տուն կամ բնակարան');

            $table->string('total_area')->nullable()->comment('ընդհանուր մակերես');
            $table->string('land_area')->nullable()->comment('հողի մակերես');
            $table->decimal('ceil_height',$precision = 8, $scale = 2)->nullable()->comment('առաստաղի բարձրություն');

            $table->integer('rooms')->nullable()->comment('սենյակների քանակ');
            $table->integer('bathrooms')->nullable()->comment('սանհանգույցների քանակ');

            $table->tinyInteger('has_elevator')->nullable()->comment('վերելակ');
            $table->tinyInteger('has_balcony')->default(0)->comment('պատշգամբ');
            $table->tinyInteger('separate_building')->default(0)->comment('առանձին շինություն');

            $table->string('forehead_length')->nullable()->comment('ճակատի երկարություն (հողատարածք)');
            $table->string('depth')->nullable()->comment('խորություն (հողատարածք)');
            $table->tinyInteger('demolition')->default(0)->comment('քանդման ենթակա շինություն(հողատարածք)');
//            $table->text('comment')->nullable();


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('announcement_details');
    }
}
