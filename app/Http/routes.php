<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'TrackController@welcome');

//Track Routes...
Route::group(['prefix' => 'api/v1'], function () {
    Route::get('/dubz', 'TrackController@trax');
    Route::get('/download/{track}', 'TrackController@download');
    Route::post('/upload', 'TrackController@store');
    Route::get('/csrf', 'TrackController@getCSRF');
});
Route::get('/dubz', 'TrackController@index');
Route::post('/track', 'TrackController@store');
Route::get('/upload', 'TrackController@uploadPage');
Route::get('/dubz/download/{track}', 'TrackController@download');
