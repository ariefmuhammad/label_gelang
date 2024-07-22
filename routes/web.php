<?php
Route::get('/dokter/data', 'DataController@dokter');
Route::get('/petugas_lab/data', 'DataController@petugasLab');
Route::get('/laboratorium/data', 'DataController@tindakanLab');
// Route::get('/laboratorium/data/bpjs', 'DataController@tindakanLabBpjs');
// Route::get('/laboratorium/data/omega', 'DataController@tindakanLabOmega');
// Route::get('/laboratorium/data/prodia', 'DataController@tindakanLabProdia');
Route::get('/radiologi/data', 'DataController@tindakanRadiologi');
Route::post('/resep/data', 'ObatController@OrderResep');
Route::post('/', 'DataController@cari');
// Route::get('/{id}/label', 'DataController@label');
Route::get('/{id}/{awalan}/{tgl_masuk}/label', 'PrintController@templateLabel');
Route::get('/{id}/{awalan}/{tgl_masuk}/gelang_dewasa', 'PrintController@templateGelangDewasa');
Route::get('/{id}/{awalan}/{tgl_masuk}/gelang_anak', 'PrintController@templateGelangAnak');
Route::get('/{id}/{awalan}/{tgl_masuk}/{peminjam}/tracer', 'PrintController@templateTracer');
Route::get('/{id}/{awalan}/{tgl_masuk}/{peminjam}/{no_urut}/tracer_v2', 'PrintController@templateTracerV2');
Route::get('/{id}/{awalan}/{tgl_masuk}/testtujuan', 'PrintController@testtujuan');


Route::get('/{id}/{awalan}/{tgl_masuk}/{status}/{nama_dokter}/{nama_petugas_lab}/{total_tarif}/{tarif}/Laboratorium', 'PrintController@templateLaboratorium')->name('print_laboratorium');
Route::get('/{id}/{awalan}/{tgl_masuk}/{status}/{nama_dokter}/{total_tarif}/{tarif}/Radiologi', 'PrintController@templateRadiologi');

Route::get('/{id}/klaimkronis', 'PrintController@klaimkronis')->name('print_klaimkronis');
Route::get('/{id}/klaiminacbg', 'PrintController@klaiminacbg')->name('print_klaiminacbg');
Route::get('/{id}/klaimnormal', 'PrintController@klaimnormal')->name('print_klaimnormal');

Route::get('/tracer/data', 'DataController@tracerData');
Route::post('/tracer/data', 'DataController@cariTracerData');

Route::get('/pasien/data/{id}', 'DataController@pasienData');
Route::get('/pasien/data/ugd/{id}', 'DataController@pasienDataUGD');
// Route::get('/pasien/data', 'DataController@cariData');

// Route::get('/test', 'DataController@test');

// route::get('/templatelabel','PrintController@templateLabel');
route::get('/templategelangdewasa','PrintController@templateGelangDewasa');
route::get('/templategelanganak','PrintController@templateGelangAnak');
route::get('/templatetracer','PrintController@templateTracer');

Route::post('/triage/data', 'TriageController@Triage');
Route::get('/{id}/triage', 'PrintController@triage')->name('print_triage');


Route::any('{all}', function () {
    return view('hiyaa');
})
->where(['all' => '.*']);





