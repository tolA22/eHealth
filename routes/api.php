<?php

use Illuminate\Http\Request;
use App\Http\Controllers;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::prefix('user')->group(function(){
    Route::post('register','UserController@register');

    Route::post('login','UserController@login');
});


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::middleware('auth:api')->group(function(){

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
});
