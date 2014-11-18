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
        $ratings = Rate::where('score', '>', 0)->take(10)->get();
        foreach ($ratings as $rating) {
            print_r($rating);
        }
        die();
    }

}
