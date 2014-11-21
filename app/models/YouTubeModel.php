<?php
/**
 * Created by PhpStorm.
 * User: kevin
 * Date: 11/21/14
 * Time: 7:33 AM
 */

class YouTubeModel extends APIModel {

    private static $endPoint = "https://content.googleapis.com/youtube/v3";
    private static $key = "AIzaSyBf6lUGqowSjbJNC7eL61cPS2mBj8wF2NM";

    public static function getRoot() {
        return self::$endPoint;
    }

    public static function request($method, $path, $data) {
        $API = new MusixMatchModel();
        $data['key'] = self::$key;
        $ip = '123.123.123.123';
        return $API->call($method, self::getRoot() . $path, $data, array("REMOTE_ADDR: $ip", "HTTP_X_FORWARDED_FOR: $ip"));
    }

    public static function lookUp($q) {
        $API = new YouTubeModel();
        $cacheLabel = $API->getCacheLabel(array('YouTubeModel', 'lookUp', $q));
        if (true || Cache::get($cacheLabel) === null) {
            $result = self::request('GET', '/search', array(
                'part' => 'id',
                'type' => 'video',
                'q' => $q,
                'videoEmbeddable' => 'true',
                'maxResults' => 1
            ));
            $result = json_decode($result);
            Cache::put($cacheLabel, $result, 0);
        } else {
            $result = Cache::get($cacheLabel);
        }
        return $result;
    }

} 