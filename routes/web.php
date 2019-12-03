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
//Register Route
Route::get('/dRegister','Register\GetRegisterController@index')->name('registerGet');
Route::post('/dRegister','Register\PostRegisterController@index')->name('registerPost');
//Password Reset Route
Route::get('/dPasswordReset','Reset\GetPasswordResetController@index')->name('passwordResetGet');
Route::post('/dPasswordReset','Reset\PostPasswordResetController@index')->name('passwordResetPost');
Route::get('/dPasswordResetChange','Reset\GetPasswordResetController@getResetChange')->name('passwordResetChangeGet');

//Diary Home
Route::get('/dHome','GetHomeController@index')->name('homeGet');
Route::get('/dLogout','GetHomeController@logout')->name('homeLogout');
//Diary User Profile
Route::get('/userProfile','Profile\GetProfileController@index')->name('userProfileGet');
Route::post('/userProfile','Profile\PostProfileController@index')->name('userProfilePost');
