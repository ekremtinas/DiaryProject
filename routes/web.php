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
//Login Route
Route::get('/dLogin','Login\GetLoginController@index')->name('loginGet');
Route::post('/dLogin','Login\PostLoginController@index')->name('loginPost');
//Diary Home
Route::get('/dHome','GetHomeController@index')->name('homeGet');
Route::get('/dLogout','GetHomeController@logout')->name('homeLogout');
