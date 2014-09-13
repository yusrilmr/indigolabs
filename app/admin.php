<?php
/*Data Master Dosen*/
Route::get('admin/datamasterdosen',array('uses'=>'AdminController@datamasterdosen'));
Route::post('admin/datamasterdosen/insert','AdminController@tambahdosen');
Route::get('admin/datamasterdosen/delete/{user_id}','AdminController@hapusDosen');
Route::get('admin/datamasterdosen/active/{user_id}','AdminController@activeDosen');
Route::post('admin/datamasterdosen/update','AdminController@updateDosen');

/*All About Lab*/
Route::get('admin/datamaster/lab', 'AdminController@lab');
Route::post('admin/datamaster/lab/insert', 'AdminController@store');
Route::post('admin/datamaster/lab/update/{lab_id}', 'AdminController@updateLab');
Route::get('admin/datamaster/lab/delete/{lab_id}', 'AdminController@deleteLab');
Route::get('admin/datamaster/lab/asisten/{lab_id}', array('as' => 'asisten','uses'=>'AdminController@asisten'));

/*All About Practicum*/
Route::get('admin/datamaster/lab/praktikum/{lab_id}', array('as' => 'praktikum','uses'=>'AdminController@praktikum'));
Route::post('admin/datamaster/lab/praktikum/insert', 'AdminController@storePraktikum');
Route::post('admin/datamaster/lab/praktikum/update/{praktikum_id}', 'AdminController@updatePraktikum');
Route::get('admin/datamaster/lab/praktikum/delete/{praktikum_id}/{lab_id}', 'AdminController@deletePraktikum');

/*All About Asisten Lab*/
Route::get('admin/datamaster/lab/asisten/{lab_id}', array('as' => 'asisten','uses'=>'AdminController@asisten'));
Route::post('admin/datamaster/lab/asisten/insert', 'AdminController@storeAsisten');
Route::post('admin/datamaster/lab/asisten/update/{asisten_nim_old}', 'AdminController@updateAsisten');
Route::get('admin/datamaster/lab/asisten/delete/{asisten_nim}/{lab_id}', 'AdminController@deleteAsisten');

/*All About Detail Praktikum*/
Route::get('admin/datamaster/lab/{lab_id}/praktikum/{praktikum_id}/detail', array('as' => 'modul', 'uses' => 'AdminController@detailPraktikum'));
Route::post('admin/datamaster/lab/asisten/praktikum/insertModul', 'AdminController@storeModul');
Route::post('admin/datamaster/lab/asisten/praktikum/update/{modul_id}', 'AdminController@updateModul');
Route::post('admin/datamaster/lab/asisten/praktikum/insertAsisten', 'AdminController@storeAsistenPraktikum');
Route::post('admin/datamaster/lab/asisten/praktikum/update/asistenPraktikum/{asisten_nim}', 'AdminController@updateAsistenPraktikum');
Route::get('admin/datamaster/lab/praktikum/modul/delete/{modul_id}/{lab_id}/{praktikum_id}', 'AdminController@deleteModul');
Route::get('admin/datamaster/lab/praktikum/asistenPraktikum/delete/{asisten_nim}/{lab_id}/{praktikum_id}', 'AdminController@deleteAsistenPraktikum');

/*All About Detail Praktikum - SOAL */
Route::get('lab/{lab_id}/praktikum/{praktikum_id}/modul/{modul_id}/listsoal', array('as' => 'modul', 'uses' => 'AdminController@listSoalPraktikum'));
Route::post('lab/asisten/praktikum/insertQuiz', 'AdminController@storeQuiz');
Route::get('lab/asisten/praktikum/deleteQuiz/{lab_id}/{praktikum_id}/{modul_id}/{quiz_id}', 'AdminController@deleteQuiz');

Route::get('lab/{lab_id}/praktikum/{praktikum_id}/modul/{modul_id}/listsoal/{quiz_id}', array('as' => 'modul', 'uses' => 'AdminController@listDetailSoalPraktikum'));
Route::post('lab/asisten/praktikum/insertSoal', 'AdminController@storeSoal');

//PLAY
Route::get('praktikum/pra', 'AdminController@praktikumPra');
Route::get('praktikum/pra/{praktikum_id}', 'AdminController@praktikumPraDetail');
Route::post('praktikum/pra/insert', 'AdminController@storeRunning');

Route::get('praktikum/stop/{praktikum}/{running_id}', 'AdminController@stopRunning');
Route::get('praktikum/koreksi/{running_id}', 'AdminController@praktikumKoreksiList');
Route::get('praktikum/koreksi/{modul_id}/{user_id}', 'AdminController@praktikumKoreksiDetail');
Route::post('nilai/updateNilai', 'AdminController@updateNilai');


/*All About Ruangan*/
Route::get('admin/ruang', 'AdminController@ruang');
Route::post('admin/ruang/insert', 'AdminController@storeRuang');
Route::post('admin/ruang/update/{ruang_id}', 'AdminController@updateRuang');
Route::get('admin/ruang/delete/{ruang_id}', 'AdminController@deleteRuang');

/*All About Jadwal*/
Route::get('admin/jadwal', 'AdminController@jadwal');
Route::post('admin/jadwal/insert', 'AdminController@storeJadwal');
Route::post('admin/jadwal/update/{jadwal_id}', 'AdminController@updateJadwal');
Route::get('admin/jadwal/delete/{jadwal_id}', 'AdminController@deleteJadwal');

/*All About Upload*/
Route::get('upload', 'AdminController@upload');
Route::post('upload/insert',array('uses'=>'AdminController@uploadFile'));
Route::post('upload/download/{item_kode}', 'AdminController@downloadFile');

