<?php
Route::get('DataMaster/Dosen',array('uses'=>'AdminController@datamasterdosen'));
Route::get('DataAbsen/AbsenPraktikum',array('uses'=>'DosenController@dataabsen'));
Route::get('DataAbsen/DaftarLab',array('uses'=>'DosenController@listpraktikumlab'));
Route::get('DataAbsen/PilihKelas',array('uses'=>'DosenController@listkelas'));
Route::get('DataAbsen/PilihPraktikumLab',array('uses'=>'DosenController@pilihpraktikumlab'));
Route::get('DataAbsen/PrintAbsen',array('uses'=>'DosenController@printabsen'));