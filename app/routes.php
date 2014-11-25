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

Route::any('/1.0/proxy/video/{path}', array('uses' => 'VideoController@lookUp_10'));
Route::any('/1.0/proxy/music/{path}', array('uses' => 'MusicController@lookUp_10'));
Route::get('/1.0/rate/', array('uses' => 'RateController@lookUp_10'));
Route::post('/1.0/rate/', array('uses' => 'RateController@rate_10'));
Route::any('/', function() {
    return Redirect::to('/api-docs/');
});