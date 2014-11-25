<?php
use Madcoda\Youtube;

/**
 * Created by PhpStorm.
 * User: kevin
 * Date: 11/21/14
 * Time: 7:33 AM
 */

class YouTubeModel extends APIModel {

    private static $key = "AIzaSyBf6lUGqowSjbJNC7eL61cPS2mBj8wF2NM";

    public static function getYouTube() {
        return new Youtube(array('key' => self::$key));
    }

    public static function lookUp($params) {
        $API = new YouTubeModel();
        $cacheLabel = $API->getCacheLabel(array('YouTubeModel', 'lookUp', serialize($params)));
        if (Cache::get($cacheLabel) === null) {
            $results = self::getYouTube()->searchAdvanced($params, true);
            $results = $results['results'];
            foreach ($results as $result) {
                self::saveYouTubeVideo($result);
            }
            Cache::put($cacheLabel, $results, 0);
        }
        $results = Cache::get($cacheLabel);
        return $results;
    }

    public static function saveYouTubeVideo($video) {
        if (isset($video->id->videoId)) {
            $counter = DB::table('video')->where('videoID', $video->id->videoId)->count();
            if ($counter == 0) {
                $data = array(
                    'videoID' => $video->id->videoId,
                );
                DB::table('video')->insert(
                    $data
                );
            }
        }
    }

} 