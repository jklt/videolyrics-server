<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::any('/1.0/proxy/youtube/{path?}', array('uses' => 'VideoController@lookUpYouTube_10'))->where('path', '(.*)');
Route::any('/1.0/proxy/spotify/{path?}', array('uses' => 'MusicController@lookUpSpotify_10'))->where('path', '(.*)');
Route::any('/1.0/proxy/chartlyrics/{path?}', array('uses' => 'MusicController@lookUpChartLyrics_10'))->where('path', '(.*)');
Route::any('/1.0/scraper/azlyrics/', array('uses' => 'LyricsController@scrapeLyrics_10'))->where('path', '(.*)');
Route::get('/1.0/rate/', array('uses' => 'RateController@lookUp_10'));
Route::post('/1.0/rate/', array('uses' => 'RateController@rate_10'));
Route::any('/', function() {
    return Redirect::to('/api-docs/');
});