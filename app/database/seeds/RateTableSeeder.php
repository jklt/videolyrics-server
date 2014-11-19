<?php
class RateTableSeeder extends Seeder {

    public function run()
    {
        DB::table('rate')->delete();

        for ($i = 0; $i < 100; $i++) {
            for ($j = 0; $j < 20; $j++) {
                Rate::create(array(
                    'objectType' => 'video',
                    'objectID' => md5($i),
                    'IP' => $i . '.' . $j . '.111.111',
                    'score' => 2 * rand(0, 1) - 1
                ));
            }
        }
    }

}