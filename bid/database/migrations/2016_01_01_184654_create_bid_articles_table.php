<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBidArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bid_articles', function (Blueprint $table) {
            $table->increments('id');
            $table->text('content');
            $table->string('name');
            $table->string('company');
            $table->double('price', 20, 2);
            $table->date('date');
            $table->string('url');
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
        Schema::drop('bid_articles');
    }
}
