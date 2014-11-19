<?php
/**
 * Created by PhpStorm.
 * User: kevin
 * Date: 11/18/14
 * Time: 7:24 PM
 */

class RateController extends BaseController {

    public function rateVideo()
    {
        echo 'test';
        $ratings = Rate::all();
        foreach ($ratings as $rating) {
            var_dump($rating);
        }
        die();
    }

}
