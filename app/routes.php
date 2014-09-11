<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.

NOTE:
	Role:
	0 - Admin
	1 - Kordas
	2 - Korprak
	3 - Asisten
	4 - Praktikan
	5 - Dosen
|
*/
Route::get('/', function()
{
	if(Session::has('user_name','role_id')){
		
		switch (Session::get('role_id')) {
			case '0':
				return Redirect::route('dashboard');
				break;
			case '1':
				return Redirect::route('dashboardKordas');
				break;
			case '2':
				return Redirect::route('dashboardKorprak');
				break;
			case '3':
				return Redirect::route('dashboardAsisten');
				break;
			case '4':
				return Redirect::route('dashboardPraktikan');
				break;
			case '5':
				return Redirect::route('dashboardDosen');
				break;
			default:
				return View::make('login');
				break;
		}

	}else{
		return View::make('login');
	}
});

Route::get('test', 'DosenController@absensiLab');

Route::get('login', function()
{
	return View::make('login');
});
Route::get('register',array('uses'=>'HomeController@register'));

/*Register-ing Accounts*/
Route::get('registerAdmin', function()
{
	return View::make('register_admin');
});


/* Registration Users */
Route::post('registeringAdmin',array('uses'=>'HomeController@RegisterAdmin'));
Route::post('registeringPraktikan',array('uses'=>'HomeController@RegisterPraktikan'));

/*Dashboard Route*/

Route::get('/admin', array('as' => 'dashboard', 'uses' => 'AdminController@showWelcome'));
Route::get('/kordas', array('as' => 'dashboardKordas', 'uses' => 'KordasController@showWelcome'));
Route::get('/korprak', array('as' => 'dashboardKorprak', 'uses' => 'KorprakController@showWelcome'));
Route::get('/asisten', array('as' => 'dashboardAsisten', 'uses' => 'AsistenController@showWelcome'));
Route::get('/praktikan', array('as' => 'dashboardPraktikan', 'uses' => 'PraktikanController@showWelcome'));
Route::get('/dosen', array('as' => 'dashboardDosen', 'uses' => 'DosenController@showWelcome'));

Route::post('authenticate',array('uses'=> 'HomeController@authenticate'));
Route::get('logout', array('uses' => 'HomeController@doLogout'));

/* Profile */
Route::get('/profile', 'ProfileController@selectProfile');

/*Role Route Pages*/
@include "admin.php";
@include "kordas.php";
@include "korprak.php";
@include "asisten.php";
@include "praktikan.php";
@include "dosen.php";