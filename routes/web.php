<?php

use Illuminate\Support\Facades\Route;

// Rute untuk pengguna tamu (guest)
Route::group(['middleware' => 'guest'], function () {
    Route::get('/login', 'GeneralController@loginPage');
    Route::post('/login', 'GeneralController@cekLogin');
});

// Rute untuk pengguna yang sudah terautentikasi (auth)
Route::group(['middleware' => 'auth'], function () {
    // Rute utama
    Route::get('/', function () {
        return redirect('/karyawan/aktif');
    });

    // Rute untuk mengirim SMS
    Route::post('/send-sms', 'KaryawanController@sendSMS');

    // Rute untuk entitas Karyawan
    Route::any('/karyawan/data/{jenis}', 'KaryawanController@data');
    Route::get('/karyawan/export', 'KaryawanController@exportData');
    Route::post('/karyawan/export_terpilih', 'KaryawanController@exportDataTerpilih');
    Route::get('/karyawan/{jenis}', 'KaryawanController@index');
    Route::post('/karyawan', 'KaryawanController@create');
    Route::patch('/karyawan', 'KaryawanController@edit');
    Route::post('/karyawan/update_status', 'KaryawanController@updateStatus');
    Route::put('/karyawan', 'KaryawanController@importDataKaryawan');
    Route::post('/karyawan/non-aktifkan', 'KaryawanController@nonAktifkanBanyak');
    Route::post('/karyawan/aktifkan', 'KaryawanController@aktifkanBanyak');
    Route::get('/karyawan/download_pdf/{id}', 'KaryawanController@downloadPdf');
    Route::get('/karyawan/foto/{id}', 'KaryawanController@getFoto');

    // Rute untuk entitas Presensi
    Route::any('/presensi/data', 'PresensiController@data');
    Route::put('/presensi', 'PresensiController@importDataPresensi');
    Route::resource('/presensi', 'PresensiController');

    // Rute untuk entitas Struktur Organisasi
    Route::any('/struktur_organisasi/data', 'OrganisasiController@data');
    Route::post('/struktur_organisasi/edit', 'OrganisasiController@edit');
    Route::get('/struktur_organisasi/delete/{id}', 'OrganisasiController@hapus');
    Route::any('/struktur_organisasi/detail/{id}', 'OrganisasiController@showOne');
    Route::resource('/struktur_organisasi', 'OrganisasiController');

    // Rute untuk entitas User
    Route::any('/user/data', 'UserController@data');
    Route::post('/user/edit', 'UserController@edit');
    Route::get('/user/delete/{id}', 'UserController@hapus');
    Route::post('/user/hapus_beberapa', 'UserController@hapusBeberapa');
    Route::resource('/user', 'UserController');

    // Rute untuk Pengaturan
    Route::get('/pengaturan', 'PengaturanController@index');
});

// Rute untuk logout
Route::get('/logout', 'GeneralController@logout');
