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

// --- DashboardController
Route::get('/', 'DashboardController@getIndex');

// --- ActivityController
Route::get('/program'     , 'ActivityController@getProgramIndex');
Route::get('/program/{id}', 'ActivityController@getProgramDetail');
Route::get('/program/buat', 'ActivityController@getProgramCreate');
