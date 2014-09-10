<?php
/*Register Praktikum*/
Route::get('praktikan/RegisterPraktikum',array('uses'=>'PraktikanController@registrasipraktikum'));
Route::get('praktikan/PilihPraktikum',array('uses'=>'PraktikanController@pilihpraktikum'));
Route::get('praktikan/PilihJadwal',array('uses'=>'PraktikanController@pilihjadwal'));
Route::get('praktikan/submitJadwal', array('uses' => 'PraktikanController@submitJadwal'));
Route::get('praktikan/HapusPraktikum',array('uses'=>'PraktikanController@hapuspraktikum'));


/* PRAKTIKUM COY */
Route::get('praktikum/list/{runnning_id}', 'PraktikanController@praktikumList');
Route::get('praktikum/start/{runnning_id}/{quiz_id}/{nomor}', 'PraktikanController@praktikumSoal');
Route::post('praktikum/update1', 'PraktikanController@updateJawaban1');
Route::post('praktikum/update2', 'PraktikanController@updateJawaban2');
Route::post('praktikum/update3', 'PraktikanController@updateJawaban3');