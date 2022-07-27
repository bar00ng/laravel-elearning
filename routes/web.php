<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('login');
});

Route::group(['middleware' => ['auth']], function(){
    Route::get('/dashboard', 'App\Http\Controllers\DashboardController@index')->name('dashboard');
});

Route::group(['middleware'=>['auth','role:admin']], function(){
    // Menampilkan list semua mahasiswa
    Route::get('Mahasiswa','App\Http\Controllers\MahasiswaController@listMahasiswa')->name('Mahasiswa');

    // Membuka form tambah mahasiswa
    Route::get('Mahasiswa/add','App\Http\Controllers\MahasiswaController@formAdd')->name('Mahasiswa.add');

    // Memasukkan data ke DB
    Route::post('Mahasiswa/add', 'App\Http\Controllers\MahasiswaController@simpanDataMahasiswa');

    // Menghapus data dari DB
    Route::delete('Mahasiswa/{id}', 'App\Http\Controllers\MahasiswaController@hapusDataMahasiswa');

    // Membuka form edit mahasiswa
    Route::get('Mahasiswa/edit/{id}', 'App\Http\Controllers\MahasiswaController@formEdit')->name('Mahasiswa.edit');

    // Mengedit data mahasiswa
    Route::patch('Mahasiswa/edit/{id}', 'App\Http\Controllers\MahasiswaController@simpanEditMahasiswa');


    // Menampilkan list semua Dosen
    Route::get('Dosen','App\Http\Controllers\DosenController@listDosen')->name('Dosen');

    // Membuka form tambah Dosen
    Route::get('Dosen/add','App\Http\Controllers\DosenController@formAdd')->name('Dosen.add');

    // Memasukkan data ke DB
    Route::post('Dosen/add', 'App\Http\Controllers\DosenController@simpanDataDosen');
    
    // Menghapus data dari DB
    Route::delete('Dosen/{id}', 'App\Http\Controllers\DosenController@hapusDataDosen');

    // Membuka form edit mahasiswa
    Route::get('Dosen/edit/{id}', 'App\Http\Controllers\DosenController@formEdit')->name('Dosen.edit');

    // Mengedit data mahasiswa
    Route::patch('Dosen/edit/{id}', 'App\Http\Controllers\DosenController@simpanEditDosen');


    // Menampilkan list semua Kelas
    Route::get('Kelas','App\Http\Controllers\KelasController@listKelas')->name('Kelas');

    // Membuka form tambah Kelas
    Route::get('Kelas/add','App\Http\Controllers\KelasController@formAdd')->name('Kelas.add');

    // Memasukkan data ke DB
    Route::post('Kelas/add', 'App\Http\Controllers\KelasController@simpanDataKelas');
    
    // Menghapus data dari DB
    Route::delete('Kelas/{id}', 'App\Http\Controllers\KelasController@hapusDataKelas');

    // Membuka form edit Kelas
    Route::get('Kelas/edit/{id}', 'App\Http\Controllers\KelasController@formEdit')->name('Kelas.edit');

    // Mengedit data Kelas
    Route::patch('Kelas/edit/{id}', 'App\Http\Controllers\KelasController@simpanEditKelas');
});

Route::group(['middleware'=>['auth','role:dosen|superadministrator']],function(){
    Route::get('Tugas','App\Http\Controllers\TugasController@listTugas')->name('Tugas');

    // Membuka form tambah Tugas
    Route::get('Tugas/add','App\Http\Controllers\TugasController@formAdd')->name('Tugas.add');

    // Memasukkan data ke DB
    Route::post('Tugas/add', 'App\Http\Controllers\TugasController@simpanDataTugas');

    // Menghapus data dari DB
    Route::delete('Tugas/{id}', 'App\Http\Controllers\TugasController@hapusDataTugas');

    // Membuka form edit Kelas
    Route::get('Tugas/edit/{id}', 'App\Http\Controllers\TugasController@formEdit')->name('Tugas.edit');

    // Mengedit data Kelas
    Route::patch('Tugas/edit/{id}', 'App\Http\Controllers\TugasController@simpanEditTugas');

    Route::get('Tugas/detail/{id}', 'App\Http\Controllers\TugasController@detailTugas')->name('Tugas.detail');

    Route::patch('Tugas/store/{TugasId}/{ScoreId}', 'App\Http\Controllers\TugasController@storeNilai')->name('Tugas.store');
});

Route::group(['middleware'=>['auth','role:mahasiswa|superadministrator']],function(){
    Route::get('Assignment','App\Http\Controllers\AssignmentController@listTugas')->name('Assignment');

    Route::get('detailAssignment/{id}','App\Http\Controllers\AssignmentController@detailTugas')->name('Assignment.detail');

    Route::post('submitTugas/{tugasId}','App\Http\Controllers\AssignmentController@submitTugas');
});

require __DIR__.'/auth.php';
