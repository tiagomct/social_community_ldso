<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('votes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('referendum_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->integer('decision');       // if it is 1 it is vote UP if it is 0 it is vote DOWN
            $table->timestamp('created_at');


            $table->foreign('referendum_id')->references('id')->on('referendums');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('votes');
    }
}
