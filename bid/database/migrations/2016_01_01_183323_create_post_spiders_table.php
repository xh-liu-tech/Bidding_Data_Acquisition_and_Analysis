<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostSpidersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_spiders', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('allowed_domain');
            $table->string('start_url');
            $table->string('csrftoken_xpath');
            $table->string('viewstate_xpath');
            $table->string('page_count_xpath');
            $table->string('eventtarget_content');
            $table->string('viewstateencrypted_content');
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
        Schema::drop('post_spiders');
    }
}
