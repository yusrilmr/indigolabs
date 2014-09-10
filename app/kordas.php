<?php
//Route::get('DataMaster/Dosen',array('uses'=>'AdminController@datamasterdosen'));

/*All About Lab*/
Route::get('kordas/datamaster/lab', 'KordasController@lab');
Route::post('kordas/datamaster/lab/update/{lab_id}', 'KordasController@updateLab');
Route::get('kordas/datamaster/lab/asisten/{lab_id}', array('as' => 'asistenKordas','uses'=>'KordasController@asisten'));

/*All About Practicum*/
Route::get('kordas/datamaster/lab/praktikum/{lab_id}', array('as' => 'praktikumKordas','uses'=>'KordasController@praktikum'));
Route::post('kordas/datamaster/lab/praktikum/insert', 'KordasController@storePraktikum');
Route::post('kordas/datamaster/lab/praktikum/update/{praktikum_id}', 'KordasController@updatePraktikum');
Route::get('kordas/datamaster/lab/praktikum/delete/{praktikum_id}/{lab_id}', 'KordasController@deletePraktikum');

/*All About Asisten Lab*/
Route::get('kordas/datamaster/lab/asisten/{lab_id}', array('as' => 'asistenKordas','uses'=>'KordasController@asisten'));
Route::post('kordas/datamaster/lab/asisten/insert', 'KordasController@storeAsisten');
Route::post('kordas/datamaster/lab/asisten/update/{asisten_nim_old}', 'KordasController@updateAsisten');
Route::get('kordas/datamaster/lab/asisten/delete/{asisten_nim}/{lab_id}', 'KordasController@deleteAsisten');

/*All About Detail Praktikum*/
Route::get('kordas/datamaster/lab/{lab_id}/praktikum/{praktikum_id}/detail', array('as' => 'modulKordas', 'uses' => 'KordasController@detailPraktikum'));
Route::post('kordas/datamaster/lab/asisten/praktikum/insertModul', 'KordasController@storeModul');
Route::post('kordas/datamaster/lab/asisten/praktikum/update/{modul_id}', 'KordasController@updateModul');
Route::post('kordas/datamaster/lab/asisten/praktikum/insertAsisten', 'KordasController@storeAsistenPraktikum');
Route::post('kordas/datamaster/lab/asisten/praktikum/update/asistenPraktikum/{asisten_nim}', 'KordasController@updateAsistenPraktikum');
Route::get('kordas/datamaster/lab/praktikum/modul/delete/{modul_id}/{lab_id}/{praktikum_id}', 'KordasController@deleteModul');
Route::get('kordas/datamaster/lab/praktikum/asistenPraktikum/delete/{asisten_nim}/{lab_id}/{praktikum_id}', 'KordasController@deleteAsistenPraktikum');


/*All About Jadwal*/
Route::get('kordas/jadwal', 'KordasController@jadwal');
Route::post('kordas/jadwal/insert', 'KordasController@storeJadwal');
Route::post('kordas/jadwal/update/{jadwal_id}', 'KordasController@updateJadwal');
Route::get('kordas/jadwal/delete/{jadwal_id}', 'KordasController@deleteJadwal');
