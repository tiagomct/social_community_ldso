<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUserDescrPicPolInterFields extends Migration
{
    /**
     * Adding description, image path and politics fields to user table
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function ($table) {
            $table->string('img_name')->default('default.jpg');
            $table->text('description');
            $table->text('politics');
            $table->string('interests');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function ($table) {
            $table->dropColumn('img_name');
            $table->dropColumn('description');
            $table->dropColumn('politics');
            $table->dropColumn('interests');
        });
    }
}
