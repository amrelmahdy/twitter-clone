<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFollowsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // many to many intermediary table
        Schema::create('follows', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_follow_id')->unsigned(); // user who follow
            $table->integer('user_followed_id')->unsigned(); // user being followed
            $table->timestamps();
        });



        Schema::table('follows', function (Blueprint $table) {
            $table->foreign('user_follow_id')
                ->references('id')
                ->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });

        Schema::table('follows', function (Blueprint $table) {
            $table->foreign('user_followed_id')
                ->references('id')
                ->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('follows');
    }
}
