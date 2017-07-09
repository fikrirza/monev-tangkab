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

// -- Auth
Auth::routes();

// -- Require authentication
Route::group(['middleware' => ['web', 'auth']], function () {

    // --- DashboardController
    Route::get('/', 'DashboardController@index');
    Route::get('/migration', 'DashboardController@migration');

    // --- ProgramController
    Route::resource('program', 'ProgramController');

    // --- ActivityController
    Route::resource('kegiatan', 'KegiatanController');

    // --- IndicatorContorller
    Route::resource('indikator', 'IndikatorController', [ 'only' => ['edit', 'update']]);

    // --- BudgetController
    Route::get('anggaran', 'AnggaranController@index');

    // --- RealizationController
    Route::get('laporan', 'RealisasiController@laporan');
    Route::resource('realisasi', 'RealisasiController', [ 'only' => ['index', 'create', 'store', 'update']]);

});
