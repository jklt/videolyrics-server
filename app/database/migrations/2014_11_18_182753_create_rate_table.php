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
        $this->down();
		Schema::create('rate', function(Blueprint $table)
		{
            $table->increments('rateID');
            $table->string('objectType');
            $table->string('objectID');
            $table->string('IP');
            $table->string('score');
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
	}

}