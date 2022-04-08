<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Enums\AnnouncementsEnum;

class CreateAnnouncementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('announcements', function (Blueprint $table) {
            $table->id()->startingValue(1000);

            $table->string('slug')->nullable();
            $table->unique('slug');
//            $table->integer('number');
//            $table->unique('number');

            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')
                ->references('id')->on('users')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->unsignedBigInteger('admin_id')->nullable();
            $table->foreign('admin_id')
                ->references('id')->on('admins')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->unsignedBigInteger('category_id')->nullable()->comment('գույքի տեսակ');
            $table->foreign('category_id')
                ->references('id')->on('categories');

            $table->unsignedBigInteger('sub_category_id')->nullable()->default(null)->comment('նշանակությունը');
            $table->foreign('sub_category_id')
                ->references('id')->on('categories');

            $table->string('title_am')->nullable();
            $table->string('title_en')->nullable();
            $table->string('title_ru')->nullable();
            $table->text('description')->nullable();

            $table->tinyInteger('from_constructor')->default(0)->comment('կառուցապատողից');
            $table->tinyInteger('status')->default(AnnouncementsEnum::PENDING);
            $table->tinyInteger('is_urgent')->default(0)->comment('շտապ');
            $table->tinyInteger('is_top')->default(0)->comment('տոպ');
            $table->tinyInteger('shown_phone')->default(0)->comment('ցուցադրվաժ է հեռախոսահամարը');
            $table->tinyInteger('is_negotiable')->default(0)->comment('սակարկելի');

            $table->timestamps();
            $table->timestamp('refreshed_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('announcements');
    }
}
