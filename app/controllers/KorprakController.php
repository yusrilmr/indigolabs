<?php

class KorprakController extends BaseController {
	public function __construct()
    {
        $this->beforeFilter(function()
        {
            if(Session::get('role_id')!='2'){
				return View::make('login');
			}else{
				
			}
        });
    }
	public function showWelcome()
	{
		return View::make('dashboard.korprak.korprak_index');
	}

	/*Page Jadwal*/

	public function jadwal(){
		$jadwals 	= Jadwal::where('jadwal_status', '=', 1)->get();
		$labs 		= Lab::where('lab_status', '=', 1)->get();
		$ruangs 	= Ruang::where('ruang_status', '=', 1)->get();
		$praktikums = Praktikum::all();

		return View::make('dashboard.korprak.DataMaster.jadwal')->with('jadwals', $jadwals)->with('labs', $labs)->with('ruangs', $ruangs)->with('praktikums', $praktikums);
	}

	public function deleteJadwal($jadwal_id) {
		$jadwal = Jadwal::find($jadwal_id);
		$jadwal->jadwal_status = 0;
		$jadwal->save();

		return Redirect::to('/admin/jadwal');	
	}

	public function storeJadwal() {
		$rules = array(
			'lab_nama' => 'required',
			'praktikum_id' => 'required',
			'ruang_id' => 'required',
			'jadwal_hari' => 'required',
			'shift' => 'required',
			'JamMulai' => 'required',
			'JamSelesai' => 'required'
		);
		$validator = Validator::make(Input::all(), $rules);

		if ($validator->fails()) {
			return Redirect::to('/korprak/jadwal')
				->withErrors($validator);
		} else {
		$praktikum_nama = Praktikum::where('praktikum_id', '=', Input::get('praktikum_id'))->pluck('praktikum_nama');

		$lab 		= strtoupper(substr(Input::get('lab_nama'), 0, 3));
		$praktikum 	= strtoupper(substr($praktikum_nama, 0, 3));
		$tahun		= substr(date("Y"), -2);
		$kode_ruang	= Input::get('ruang_id');
		$shift		= Input::get('shift');
		$jadwal_hari = Input::get('jadwal_hari');
		$jadwal_hari_angka = 0;

		if($jadwal_hari==="Senin"){
			$jadwal_hari_angka = 1;

		} elseif ($jadwal_hari==="Selasa") {
			$jadwal_hari_angka = 2;

		} elseif ($jadwal_hari==="Rabu") {
			$jadwal_hari_angka = 3;

		} elseif ($jadwal_hari==="Kamis") {
			$jadwal_hari_angka = 4;

		} elseif ($jadwal_hari==="Jumat") {
			$jadwal_hari_angka = 5;

		} elseif ($jadwal_hari==="Sabtu") {
			$jadwal_hari_angka = 6;

		} else {
			$jadwal_hari_angka = 0;

		}

		$format		= $lab."-".$praktikum."-".$tahun.$kode_ruang."-".$shift."-".$jadwal_hari_angka;

		$jadwal 						= new Jadwal;
		$jadwal->jadwal_nama 			= $format;
		$jadwal->jadwal_shift			= $shift;
		$jadwal->jadwal_jam_mulai  		= Input::get('JamMulai');
		$jadwal->jadwal_jam_selesai  	= Input::get('JamSelesai');
		$jadwal->ruangan_id				= Input::get('ruang_id');
		$jadwal->jadwal_hari  			= $jadwal_hari_angka;
		$jadwal->jadwal_status			= "1";
		$jadwal->praktikum_id			= Input::get('praktikum_id');

		$jadwal->save();

		return Redirect::to('/korprak/jadwal');
	}
	}

	public function updateJadwal() {
		$rules = array(
			'update_ruang_id' => 'required',
			'update_jadwal_hari' => 'required',
			'update_shift' => 'required'
		);
		$validator = Validator::make(Input::all(), $rules);

		if ($validator->fails()) {
			return Redirect::to('/korprak/jadwal')
				->withErrors($validator);
				
		} else {
		$shift = Input::get('update_shift');
		$JamMulai="";
	    $JamSelesai="";

	    switch ($shift) {
	        case "0":
	            $JamMulai = "Jam Mulai";
	            $JamSelesai = "Jam Selesai";
	            break;
	        case "1":
	            $JamMulai = "06:30:00";
	            $JamSelesai = "08:10:00";
	            break;
	        case "2":
	            $JamMulai = "08:30:00";
	            $JamSelesai = "10:10:00";
	            break;
	        case "3":
	            $JamMulai = "10:30:00";
	            $JamSelesai = "12:10:00";
	            break;
	        case "4":
	            $JamMulai = "12:30:00";
	            $JamSelesai = "14:10:00";
	            break;
	        case "5":
	            $JamMulai = "14:30:00";
	            $JamSelesai = "16:10:00";
	            break;
	        case  "6":
	            $JamMulai = "16:30:00";
	            $JamSelesai = "18:10:00";
	            break;
	        case  "7":
	            $JamMulai = "18:30:00";
	            $JamSelesai = "20:10:00";
	            break;
	    }

		$jadwal 				= Jadwal::find(Input::get('update_jadwal_id'));
		$jadwal->ruangan_id 	= Input::get('update_ruang_id');;
		$jadwal->jadwal_hari 	= Input::get('update_jadwal_hari');;
		$jadwal->jadwal_shift	= Input::get('update_shift');;
		$jadwal->jadwal_jam_mulai	= $JamMulai;;
		$jadwal->jadwal_jam_selesai	= $JamSelesai;;
		$jadwal->save();

		return Redirect::to('/korprak/jadwal');	
	}
	}
}

?>