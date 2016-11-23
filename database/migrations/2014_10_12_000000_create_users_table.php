<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('id_card')->unique();
            $table->date('birth_date');
            $table->string('password');

            $table->string('img_name')->default('default.jpg');
            $table->text('description')->nullable();
            $table->text('politics')->nullable();
            $table->text('interests')->nullable();

            $table->unsignedInteger('voting_location_id');
            $table->unsignedInteger('role_id')->default(0);

            $table->rememberToken();
            $table->timestamps();

            $table->foreign('voting_location_id')->references('id')->on('voting_locations');
            $table->foreign('role_id')->references('id')->on('roles');
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
