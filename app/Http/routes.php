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

Route::get('/', function () {
    return view('welcome');
});

Route::get('about', [
    'as' => 'about', 'uses' => 'AboutController@showIndex'
]);

Route::get('search/{query?}', 'SearchController@showIndex')->name('search.index');

Route::get('detail/{query}', 'SearchController@showDetail')->name('search.detail');

Route::get('browse/{query?}', 'SearchController@showBrowse')->name('search.browse');

