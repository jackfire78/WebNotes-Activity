<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//default route. Return to main page
Route::get('/', function () {
    return view('NotesSubmit');
});
//Return main page
Route::get('/NotesSubmit', function () {
	return view('NotesSubmit');
});
//Return main page
Route::get('/NotesSearch', function () {
	return view('NotesSearch');
});

Route::post('addNote', 'NotesController@addNote');
Route::post('searchNotes', 'NotesController@searchNotes');

