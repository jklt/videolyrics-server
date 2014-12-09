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
        $data = str_replace("\r", "", $data);
        $data = str_replace("\n", "<br />", $data);
        return array('lyrics' => $data);
    }

}