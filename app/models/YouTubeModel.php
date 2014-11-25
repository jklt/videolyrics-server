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

    public static function lookUp($q) {
        $API = new YouTubeModel();
        $cacheLabel = $API->getCacheLabel(array('YouTubeModel', 'lookUp', $q));
        if (Cache::get($cacheLabel) === null) {
            $results = self::getYouTube()->searchVideos($q);
            foreach ($results as $result) {
                self::saveYouTubeVideo($result);
            }
            Cache::put($cacheLabel, $results, 0);
        }
        $results = Cache::get($cacheLabel);
        return $results;
    }

    public static function saveYouTubeVideo($video) {
        $counter = DB::table('video')->where('videoID', $video->id->videoId)->count();
        if ($counter == 0) {
            $data = array(
                'videoID' => $video->id->videoId,
                'publishedAt' => $video->snippet->publishedAt,
                'channelId' => $video->snippet->channelId,
                'title' => $video->snippet->title,
                'search' => strtolower($video->snippet->title),
                'description' => $video->snippet->description,
                'thumbnails_default' => $video->snippet->thumbnails->default->url,
                'thumbnails_medium' => $video->snippet->thumbnails->medium->url,
                'thumbnails_high' => $video->snippet->thumbnails->high->url,
                'channelTitle' => $video->snippet->channelTitle,
                'liveBroadcastContent' => $video->snippet->liveBroadcastContent
            );
            DB::table('video')->insert(
                $data
            );
        }
    }

} 