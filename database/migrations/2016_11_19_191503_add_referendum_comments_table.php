<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddReferendumCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('referendum_comments', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('referendum_id');
            $table->unsignedInteger('user_id');
            $table->text('content');
            $table->timestamps();

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
        Schema::dropIfExists('referendum_comments');
    }
}
