<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddReferendumAnswer extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('referendum_answers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('referendum_id')->unsigned();
            $table->text('description');
            $table->unsignedInteger('number_of_votes')->default(0);
            $table->timestamps();

            $table->foreign('referendum_id')->references('id')->on('referendums');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('referendum_answers');
    }
}
