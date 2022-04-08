<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Enums\StatusesEnum;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('full_name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');

            $table->unsignedBigInteger('role_id')->nullable();
            $table->foreign('role_id')
                ->references('id')->on('user_roles')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->string('status')->default(StatusesEnum::STATUSES['not_verified']);
            $table->string('status_code')->nullable();
            $table->string('provider', 20)->nullable();
            $table->string('provider_id')->nullable();
            $table->string('provider_token')->nullable();
            $table->string('provider_refresh_token')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
