<?php
Route::get('DataMaster/Dosen',array('uses'=>'AdminController@datamasterdosen'));

/*All About Jadwal*/
Route::get('korprak/jadwal', 'KorprakController@jadwal');
Route::post('korprak/jadwal/insert', 'KorprakController@storeJadwal');
Route::post('korprak/jadwal/update/{jadwal_id}', 'KorprakController@updateJadwal');
Route::get('korprak/jadwal/delete/{jadwal_id}', 'KorprakController@deleteJadwal');
