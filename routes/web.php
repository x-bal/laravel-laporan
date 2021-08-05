<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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
    return redirect('login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::middleware('auth')->group(function () {
    Route::prefix('admin')->group(function () {
        Route::get('', 'UserController@index');
        Route::post('store', 'UserController@store');
        Route::post('update', 'UserController@update');
        Route::get('edit/{id}', 'UserController@edit');
        Route::get('delete/{id}', 'UserController@delete');
    });

    Route::prefix('user')->group(function () {
        Route::get('', 'UserController@index2');
        Route::post('store', 'UserController@store2');
        Route::post('update', 'UserController@update2');
        Route::get('edit/{id}', 'UserController@edit2');
        Route::get('delete/{id}', 'UserController@delete2');
    });

    Route::prefix('map')->group(function () {
        Route::get('', 'MapController@index');
        Route::post('store', 'MapController@store');
        Route::post('update', 'MapController@update');
        Route::get('edit/{id}', 'MapController@edit');
        Route::get('delete/{id}', 'MapController@delete');
    });


    Route::prefix('work-map')->group(function () {
        Route::get('', 'WorkMapController@index');
        Route::post('store', 'WorkMapController@store');
        Route::post('update', 'WorkMapController@update');
        Route::get('edit/{id}', 'WorkMapController@edit');
        Route::post('update2', 'WorkMapController@update2');
        Route::post('finish', 'WorkMapController@finish');
    });

    Route::get('ambil_priority', 'WorkMapController@ambil_priority');


    Route::prefix('finish-map')->group(function () {
        Route::get('', 'WorkMapController@mapFinish');
    });

    Route::prefix('error-map')->group(function () {
        Route::get('', 'ErrorMapController@index');
        Route::get('create', 'ErrorMapController@create');
        Route::post('store', 'ErrorMapController@store');
        Route::post('update', 'ErrorMapController@update');
        Route::get('edit/{id}', 'ErrorMapController@edit');
        Route::get('delete/{id}', 'ErrorMapController@delete');
    });

    Route::prefix('report')->group(function () {
        Route::get('', 'ReportController@index');
        Route::prefix('in')->group(function () {
            Route::get('', 'ReportController@in');
            Route::post('store', 'ReportController@in');
            Route::post('export', 'ReportController@exportIn');
        });
        Route::prefix('finish')->group(function () {
            Route::get('', 'ReportController@finish');
            Route::post('store', 'ReportController@finish');
            Route::post('export', 'ReportController@exportFinish');
        });
        Route::prefix('error')->group(function () {
            Route::get('', 'ReportController@error');
            Route::post('store', 'ReportController@error');
            Route::post('export', 'ReportController@exportError');
        });
        Route::prefix('progress')->group(function () {
            Route::get('', 'ReportController@progress');
            Route::post('store', 'ReportController@progress');
            Route::get('export', 'ReportController@exportProgress');
        });
        Route::prefix('total')->group(function () {
            Route::get('', 'ReportController@total');
            Route::post('store', 'ReportController@total');
            Route::get('export', 'ReportController@exportTotal');
        });

        Route::get('akumulasi', 'ReportController@akumulasi');
        Route::get('cuti', 'ReportController@cuti');
    });

    // Route Kehadiran
    Route::get('/accept/{kehadiran:id}', 'KehadiranController@accept')->name('accept');
    Route::get('/reject/{kehadiran:id}', 'KehadiranController@reject')->name('reject');
    Route::get('/lembur', 'KehadiranController@lembur')->name('lembur');
    Route::get('/cuti/{id}', 'KehadiranController@cuti')->name('cuti');
    Route::resource('/kehadiran', 'KehadiranController');

    // Route Setting
    Route::resource('/setting', 'JenisController');

    // Route Karyawan
    Route::resource('karyawan', 'KaryawanController');

    // Route bendahara
    Route::resource('bendahara', 'BendaharaController');

    // Route Gaji
    Route::get('/report/laporan', 'GajiController@laporan')->name('gaji.laporan');
    Route::get('/gaji/laporan/karyawan/{tanggal}', 'GajiController@laporanKaryawan')->name('gaji.laporanKaryawan');
    Route::get('/gaji/generate/{tanggal}', 'GajiController@generate')->name('gaji.generate');
    Route::get('/gaji/generate/{id}/{bulan}', 'GajiController@generateAdmin')->name('gaji.generate.admin');
    Route::get('/gaji/slip', 'GajiController@slip')->name('gaji.slip');
    Route::resource('/gaji', 'GajiController');

    Route::get('change-password', 'ChangePasswordController@index');
    Route::post('change-password', 'ChangePasswordController@store')->name('change.password');

    Route::get('lapor-email', 'WorkMapController@laporemail')->name('laporemail');
    Route::post('send-email', 'WorkMapController@sendemail')->name('sendemail');
});
