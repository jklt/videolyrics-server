<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRateTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('rate', function(Blueprint $table)
		{
            $table->increments('rateID');
            $table->string('objectType');
            $table->string('objectID');
            $table->string('IP');
            $table->integer('score');
            $table->timestamps();
		});
        Schema::create('music', function(Blueprint $table)
        {
            $table->increments('musicID');
            $table->integer('lyricsID');
            $table->integer('videoID');
            $table->string('image');
            $table->string('image-thumbnail');
            $table->timestamps();
        });
        Schema::create('video', function(Blueprint $table)
        {
            $table->increments('videoID');
            $table->string('URL');
            $table->timestamps();
        });
        Schema::create('lyrics', function(Blueprint $table)
        {
            $table->increments('lyricsID');
            $table->string('lyrics');
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
		Schema::table('rate', function(Blueprint $table)
		{
            Schema::dropIfExists('rate');
		});
        Schema::table('music', function(Blueprint $table)
        {
            Schema::dropIfExists('music');
        });
        Schema::table('video', function(Blueprint $table)
        {
            Schema::dropIfExists('video');
        });
        Schema::table('lyrics', function(Blueprint $table)
        {
            Schema::dropIfExists('lyrics');
        });
	}

}