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

Route::get('/video/', array('uses' => 'VideoController@lookUp'));
Route::get('/lyrics/', array('uses' => 'LyricsController@lookUp'));
Route::get('/music/', array('uses' => 'MusicController@lookUp'));
Route::get('/music/list/', array('uses' => 'MusicController@find'));
Route::get('/rate/', array('uses' => 'RateController@lookUp'));
Route::post('/rate/', array('uses' => 'RateController@rate'));
Route::any('/', function() {
    return Redirect::to('/api-docs/');
});