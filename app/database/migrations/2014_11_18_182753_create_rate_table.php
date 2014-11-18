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
		Schema::table('rate', function(Blueprint $table)
		{
            $table->increments('rateID');
            $table->string('objectType');
            $table->string('objectID');
            $table->string('IP');
            $table->integer('score');
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
	}

}

class RateTableSeeder extends Seeder {

    public function run()
    {
        DB::table('rate')->delete();

        for ($i = 0; $i < 100; $i++) {
            for ($j = 0; j < 20; $j++) {
                User::create(array(
                    'objectType' => 'video',
                    'objectID' => md5($i),
                    'IP' => $i . '.' . $j . '.111.111',
                    'score' => 2 * rand(0, 1) - 1
                ));
            }
        }
    }

}