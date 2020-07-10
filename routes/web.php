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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/schedule','ScheduleController@all')->name('schedule');

Route::prefix('schedule')->group(function(){
    // update a schedule
    Route::put('update/{id}','ScheduleController@update');

    // delete a schedule
    Route::delete('delete/{id}','ScheduleController@delete');
    
    // create schedule
    Route::post('create','ScheduleController@create');

    // approve a schedule
    Route::put('approve/{id}','ScheduleController@approve');

    // decline a schedule
    Route::put('decline/{id}','ScheduleController@decline');

    // all schedule
    Route::get('/all','ScheduleController@allSchedules');
});