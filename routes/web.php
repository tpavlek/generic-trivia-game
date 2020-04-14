<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', 'SessionController@index')->name('home.index');
Route::post('/session', 'SessionController@new')->name('session.new');
Route::get('/session/observe/{session}', 'SessionController@observe')->name('session.observe');
Route::get('/session/play/{session}', 'SessionController@join')->name('session.play');
