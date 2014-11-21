<?php
/**
 * Created by PhpStorm.
 * User: kevin
 * Date: 11/18/14
 * Time: 7:38 PM
 */

class MusixMatchModel extends APIModel {

    private static $endPoint = "https://musixmatchcom-musixmatch.p.mashape.com/wsr/1.1";
    private static $key = "M2vWzykqq9mshOXiNMBGQ8fJF1DHp16VbBwjsnyVW3CqW4ZksQ";

    public static function getHeaders() {
        return array('X-Mashape-Key: ' . self::$key);
    }

    public static function getRoot() {
        return self::$endPoint;
    }

    public static function request($method, $path, $data) {
        $API = new MusixMatchModel();
        return $API->call($method, self::getRoot() . $path, $data, self::getHeaders());
    }

    public static function lookUp($q) {
        $API = new MusixMatchModel();
        $cacheLabel = $API->getCacheLabel(array('MusixMatchModel', 'lookUp', $q));
        if (Cache::get($cacheLabel) === null) {
            $result = self::request('GET', '/track.search', array('q_artist' => 'coldplay'));
            $result = json_decode($result);
            Cache::put($cacheLabel, $result, 0);
        } else {
            $result = Cache::get($cacheLabel);
        }
        return $result;
    }

}
