<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGetSpidersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('get_spiders', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('allowed_domain');
            $table->string('start_url');
            $table->string('page_url');
            $table->string('page_count_xpath');
            $table->string('page_count_re');
            $table->string('link_xpath');
            $table->string('content_xpath');
            $table->integer('enable');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('get_spiders');
    }
}
