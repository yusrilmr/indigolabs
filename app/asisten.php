<?php
Route::get('DataMaster/Dosen',array('uses'=>'AdminController@datamasterdosen'));

Route::get('asisten/jadwal', 'AsistenController@showAbsensi');
Route::get('asisten/pilihShift', 'AsistenController@showShift');
Route::get('asisten/pilihModul', 'AsistenController@showModul');
Route::get('asisten/detailJadwal', 'AsistenController@showDetailJadwal');
Route::post('asisten/editAbsen', 'AsistenController@editAbsen');