<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RefineNewsEntriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('news_entries', function($table) {
            $table->string('img_name')->default('default.jpg');
            $table->boolean('archived')->default(false);
            $table->string('category')->default('other');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('news_entries', function($table) {
            $table->dropColumn('img_name');
            $table->dropColumn('archived');
            $table->dropColumn('category');
        });
    }
}
