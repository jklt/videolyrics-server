<?php
/**
 * Created by PhpStorm.
 * User: kevin
 * Date: 11/21/14
 * Time: 7:33 AM
 */

class YouTubeModel {

    public static function search($params) {
        $API = new APIModel('https://www.googleapis.com/youtube/v3/', ['key' => 'AIzaSyBf6lUGqowSjbJNC7eL61cPS2mBj8wF2NM']);
        return $API->call('GET', 'search', $params);
    }

    public static function lookUp($params) {
        return self::search(array('q' => 'coldplay', 'part' => 'id'));
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