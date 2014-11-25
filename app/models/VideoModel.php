<?php
/**
 * Created by PhpStorm.
 * User: kevin
 * Date: 11/21/14
 * Time: 7:17 AM
 */

class VideoModel extends Eloquent {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'video';
    protected $primaryKey = 'videoID';

    public static function lookUp($params) {
        $API = new YouTubeModel();
        $results = $API->lookUp($params);
        return $results;
    }

}
