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
Route::get('/', 'DashboardController@index');

// --- ProgramController
Route::resource('program', 'ProgramController');

// --- ActivityController
Route::resource('kegiatan', 'ActivityController');

// --- IndicatorContorller
Route::resource('indikator', 'IndicatorController', [ 'only' => ['edit', 'update']]);

// --- RealizationController
Route::resource('realisasi', 'RealizationController', [ 'only' => ['index', 'create', 'store', 'update']]);

// --- BudgetController
Route::get('anggaran', 'BudgetController@index');
