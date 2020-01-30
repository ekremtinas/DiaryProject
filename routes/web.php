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
Route::group(['middleware' => ['Cors']], function () {
//User Home
Route::get('/','UserHome\GetUserHomeController@index')->name('userHomeGet');
Route::post('/','UserHome\PostUserHomeController@index')->name('userFirstFormPost');
//User Event
Route::get('/getUserEvent', 'Home\FullCalendarController@index')->name('eventUserGet');
Route::post('/addUserEvent', 'UserHome\PostUserHomeController@create')->name('eventUserAdd');//FullCalendar Event Ekleme
Route::post('/dropUserEvent', 'Home\FullCalendarController@editTime')->name('eventUserDrop');
Route::get('/destroyUserEvent/{id}', 'Home\FullCalendarController@destroy')->name('eventUserDestroy');
Route::post('/editUserEvent', 'Home\FullCalendarController@edit')->name('eventUserEdit');
//User Event Join Maintenance
Route::get('/getUserEventsJoinMaintenance', 'Home\EventsJoinMaintenanceController@getEventsJoinMaintenance')->name('getUserEventsJoinMaintenanceGet');
//User Maintenance getUserMaintenance
Route::get('/getUserMaintenance', 'Home\MaintenanceController@getMaintenance')->name('getUserMaintenanceGet');
//Get Workplace
 Route::get('/getUserWorkplace', 'Home\FullCalendarController@getWorkplace')->name('getUserWorkplace');





//Login Route


Route::get('/dLogin','Login\GetLoginController@index')->name('loginGet');
Route::post('/dLogin','Login\PostLoginController@index')->name('loginPost');
//Register Route
Route::get('/dRegister','Register\GetRegisterController@index')->name('registerGet');
Route::post('/dRegister','Register\PostRegisterController@index')->name('registerPost');
//Password Reset Route
Route::get('/dPasswordReset','Reset\GetPasswordResetController@index')->name('passwordResetGet');
Route::post('/dPasswordReset','Reset\PostPasswordResetController@index')->name('passwordResetPost');
Route::get('/dPasswordResetConfirm','Reset\GetPasswordResetController@getResetConfirm')->name('passwordResetConfirmGet');
Route::post('/dPasswordResetConfirm','Reset\PostPasswordResetController@postResetConfirm')->name('passwordResetConfirmPost');
Route::get('/dPasswordResetConfirmLogin','Reset\GetPasswordResetController@getResetConfirmLogin')->name('passwordResetConfirmGetLogin');



Auth::routes();
Route::group(['middleware' => ['auth','admin']], function () {

//Diary Home
Route::get('/dHome','GetHomeController@index')->name('homeGet');
Route::get('/dLogout','GetHomeController@logout')->name('homeLogout');

//Diary Home Full Calendar
    Route::get('/dHome/getEvent', 'Home\FullCalendarController@index')->name('eventGet');
    Route::get('/dHome/destroyEvent/{id}', 'Home\FullCalendarController@destroy')->name('destroyEventGet');
//Maintenance
    Route::get('/dHome/getMaintenance', 'Home\MaintenanceController@getMaintenance')->name('getMaintenanceGet');
    Route::get('/dHome/deleteMaintenance', 'Home\MaintenanceController@deleteMaintenance')->name('deleteMaintenanceGet');
//EventsJoinMaintenance
    Route::get('/dHome/getEventsJoinMaintenance', 'Home\EventsJoinMaintenanceController@getEventsJoinMaintenance')->name('getEventsJoinMaintenanceGet');
 //Workplace Settings
    Route::get('/dHome/getWorkplace', 'Home\FullCalendarController@getWorkplace')->name('workplaceGet');
    Route::post('/dHome/postWorkplace', 'Home\FullCalendarController@postWorkplace')->name('workplacePost');
//Diary Home Full Calendar POST
        Route::post('/dHome/addEvent', 'Home\FullCalendarController@create')->name('addEventPost');
        Route::post('/dHome/dropEvent', 'Home\FullCalendarController@editTime')->name('dropEventGet');
        Route::post('/dHome/editEvent', 'Home\FullCalendarController@edit')->name('editEventPost');
//Maintenance POST
        Route::post('/dHome/addMaintenance', 'Home\MaintenanceController@addMaintenance')->name('addMaintenancePost');
        Route::post('/dHome/editMaintenance', 'Home\MaintenanceController@editMaintenance')->name('editMaintenancePost');





//Diary User Profile
        Route::get('/userProfile','Profile\GetProfileController@index')->name('userProfileGet');
        Route::post('/userProfile','Profile\PostProfileController@index')->name('userProfilePost');

});
});
