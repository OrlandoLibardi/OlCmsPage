<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::post('pages/preCreator/', 'PageController@postCreator')->name('create-temp-file');
Route::get('pages/temp/', 'PageController@destroyElementsTemplate');
Route::put('pages/status/', 'PageController@status');
Route::get('pages/template/{template}', 'PageController@showTemplate')->name('page-template');
Route::post('pages/picture/', 'PageController@createPicture')->name('page-picture');
Route::resource('pages','PageController');