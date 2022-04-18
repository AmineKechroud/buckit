<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::create('user_info', function (Blueprint $table) {
        //     $table->id();
        //     $table->unsignedBigInteger('user_id');
        //     $table->string('api_token', 1000)->nullable();
        //     $table->string('fcm_token', 1000)->nullable();
        //     $table->string('firebase_token', 1000)->nullable();
        //     $table->string('facebook_uid', 1000)->nullable();
        //     $table->string('google_email', 1000)->nullable();
        //     $table->string('apple_email', 1000)->nullable();
        //     $table->string('status', 30)->default('active');
        //     $table->timestamps();
        //     $table->foreign('user_id')->references('id')->on('users');
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_info');
    }
}
