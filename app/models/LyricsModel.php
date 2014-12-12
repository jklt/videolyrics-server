<?php
/**
 * Created by PhpStorm.
 * User: kevin
 * Date: 11/21/14
 * Time: 7:33 AM
 */

class LyricsModel {

    public function scrapeAll($year, $month) {
        $items = $this->fetchAllItems($year, $month);
        echo 'Done.';
    }

    public function scrape($q) {
        $url = 'http://search.azlyrics.com/search.php?q=' . urlencode($q);
        $data = file_get_contents($url);
        preg_match_all('/<div class=\"sen\">(.*?)<\/div>/s', $data, $matches);
        $data = $matches[1][0];
        preg_match_all('/href="([^"]*)"/i', $data, $matches);
        $result = $matches[1][0];
        $data = file_get_contents($result);
        $parts = explode('<!-- start of lyrics -->', $data);
        $part = $parts[1];
        $parts = explode('<!-- end of lyrics -->', $part);
        $data = $parts[0];
        $data = str_replace("<br />", "\n", $data);
        $data = str_replace("<br>", "\n", $data);
        return array('lyrics' => $data);
    }

    public function fetch($artist, $title) {
        $query = $artist . ' ' . $title;
        if (Cache::get('lyrics.apiResult' . $query) !== null) {
            $results = Cache::get('lyrics.apiResult' . $query);
        } else {
            $results = $this->find($artist . ' ' . $title);
            $results = json_decode($results, true);
            Cache::put('lyrics.apiResult' . $query, $results, 0);
        }
        $bestResult = $results[0];
        $url = $bestResult['url'];

        $hasFetched = false;
        if (Cache::get('lyrics.url' . $url) !== null) {
            $data = Cache::get('lyrics.url' . $url);
            $hasFetched = true;
        }
        $data = file_get_contents($url);
        preg_match_all('/<meta content="(.*?)" /s', $data, $matches);
        if (count($matches) == 0 || count($matches[0]) == 0) $hasFetched = false;

        if (!$hasFetched) {
            $data = file_get_contents($url);
            Cache::put('lyrics.url' . $url, $data, 0);
        }

        preg_match_all('/<meta content="(.*?)" /s', $data, $matches);
        if (count($matches) == 0 || count($matches[0]) == 0) {
            $lyrics = $bestResult['snippet'];
        } else {
            $lyrics = str_replace('&#x000A;', "\n", $matches[1][2]);
        }
        return array('lyrics' => $lyrics);
    }

    private function find($query) {
        return file_get_contents('http://api.lyricsnmusic.com/songs?api_key=2c17000c49fa97c9730eeba841d637&q=' . urlencode($query));
    }

}