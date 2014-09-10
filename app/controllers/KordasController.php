<?php

class KordasController extends BaseController {
	public function __construct()
    {
        $this->beforeFilter(function()
        {
            if(Session::get('role_id')!='1'){
				return View::make('login');
			}else{
				
			}
        });
    }
	public function showWelcome()
	{
		return View::make('dashboard.kordas.kordas_index');
		//return $this->lab();
	}
	
	public function lab(){
		$user_name = Session::get('user_name');
		$user_id = DB::table('tb_user')
					->where('user_name', '=', $user_name)
					->pluck('user_id');
		$labs = DB::table('tb_user')
		            ->join('tb_asisten', 'tb_user.user_id', '=', 'tb_asisten.user_id')
		            ->join('tb_lab', 'tb_asisten.lab_id', '=', 'tb_lab.lab_id')
		            ->where('tb_user.user_id', '=', $user_id)
		            ->select('tb_lab.lab_id', 'lab_nama', 'lab_keterangan', 'lab_ruang')
		            ->get();
		return View::make('dashboard.kordas.DataMaster.lab')->with('labs', $labs);
	}

	public function updateLab() {
		$lab 					= Lab::find(Input::get('lab_id'));
		$lab->lab_nama 			= Input::get('lab_nama');;
		$lab->lab_keterangan 	= Input::get('lab_keterangan');;
		$lab->lab_ruang 		= Input::get('lab_ruang');;
		$lab->save();

		return Redirect::to('kordas/datamaster/lab');
	}

	public function asisten($lab_id){
		$asistens 	= Asisten::where('lab_id', '=', $lab_id)->where('asisten_status', '=', 1)->get();
		$labs 		= Lab::find($lab_id);

		return View::make('dashboard.kordas.DataMaster.asisten')->with('asistens', $asistens)->with('labs', $labs);
	}

	public function storeAsisten(){
		$lab_id 				= Input::get('lab_id');;
		$asisten 				= new Asisten;

		$input=Input::all();
		$rules=array(
			'asisten_nim'=>'required|numeric',
			'asisten_kode'=>'required|alpha',
			'asisten_nama'=>'required|alpha',
			'asisten_email'=>'required|email',
			'asisten_telp'=>'required|numeric'
			);
		$validation = Validator::make($input,$rules);
		if($validation->fails()){
			return Redirect::route('asistenKordas', ['lab_id' =>  $lab_id]);
		}else{

			$asisten_nim 			= Input::get('asisten_nim');

			$asisten->asisten_nim 	= $asisten_nim;;
			$asisten->asisten_kode  = Input::get('asisten_kode');;
			$asisten->asisten_nama  = Input::get('asisten_nama');;
			$asisten->asisten_email = Input::get('asisten_email');;
			$asisten->asisten_telp  = Input::get('asisten_telp');;
			$asisten->role_id 		= 3 ;; //role id untuk asisten adalah 3 *tb_role harus diisi dahulu
			$asisten->lab_id		= $lab_id;;

		  /*Urutan input asisten :
				1. insert into tb_user
				2. insert into tb_asisten
				3. insert into tb_detail_lab_asisten*/

			Asisten::insert_tb_user($asisten_nim);	//insert into tb_user

			$user_id			= DB::table('tb_user')->where('user_name', $asisten_nim)->pluck('user_id');
			$asisten->user_id 	= $user_id;
			$asisten->save(); 	//insert into tb_asisten dengan syarat tb_role telah diisi

			return Redirect::route('asistenKordas', ['lab_id' =>  $lab_id]);
		}
	}

	public function updateAsisten() {
		$asisten 							= Asisten::find(Input::get('asisten_nim_old'));

		$asisten->asisten_nim	 			= Input::get('asisten_nim');;
		$asisten->asisten_kode	 			= Input::get('asisten_kode');;
		$asisten->asisten_nama			 	= Input::get('asisten_nama');;
		$asisten->asisten_telp			 	= Input::get('asisten_telp');;
		$asisten->save();
		$lab_id								= Input::get('lab_id');

		return Redirect::route('asistenKordas', ['lab_id' =>  $lab_id]);
	}

	public function deleteAsisten($asisten_nim, $lab_id) {
		$asisten = Asisten::find($asisten_nim);
		$asisten->asisten_status = 0;
		$asisten-> save();

		return Redirect::route('asistenKordas', ['lab_id' =>  $lab_id]);
	}

	public function praktikum($lab_id) {
		$praktikums = Praktikum::where('lab_id', '=', $lab_id)->where('praktikum_status', '=', 1)->get();
		$labs 		= Lab::find($lab_id);
		return View::make('dashboard.kordas.DataMaster.praktikum')->with('praktikums', $praktikums)->with('labs', $labs);
	}

	public function storePraktikum() {
		$lab_id 	= Input::get('lab_id');
		$praktikum 	= new Praktikum;
		$input=Input::all();
		$rules=array(
			'praktikum_nama'=>'required|alpha',
			'praktikum_keterangan'=>'required'
			);
		$validation = Validator::make($input,$rules);
		if($validation->fails()){
			return Redirect::route('praktikum', ['lab_id' =>  $lab_id]);
		}else{
			$praktikum->praktikum_nama = Input::get('praktikum_nama');;
			$praktikum->praktikum_keterangan  = Input::get('praktikum_keterangan');;
			$praktikum->lab_id = Input::get('lab_id');;

			$praktikum->save();
			return Redirect::route('praktikumKordas', ['lab_id' =>  $lab_id]);
		}
	}

	public function updatePraktikum() {
		$praktikum 							= Praktikum::find(Input::get('praktikum_id'));
		$praktikum->praktikum_nama 			= Input::get('praktikum_nama');;
		$praktikum->praktikum_keterangan 	= Input::get('praktikum_keterangan');;
		$praktikum->save();
		$lab_id								= Input::get('lab_id');

		return Redirect::route('praktikumKordas', ['lab_id' =>  $lab_id]);
	}

	public function deletePraktikum($praktikum_id, $lab_id) {
		$praktikum = Praktikum::find($praktikum_id);
		$praktikum->praktikum_status = 0;
		$praktikum->save();

		return Redirect::route('praktikumKordas', ['lab_id' =>  $lab_id]);
	}

	public function detailPraktikum($lab_id, $praktikum_id){
		$labs 		= Lab::find($lab_id);
		$praktikum  = Praktikum::find($praktikum_id);
		$moduls		= DB::table('tb_modul')->where('praktikum_id', '=', $praktikum_id)->get();
		$asistens	= DB::table('tb_detail_praktikum_asisten')
															->join('tb_asisten', 'tb_asisten.asisten_nim', '=', 'tb_detail_praktikum_asisten.asisten_nim')
															->where('praktikum_id', '=', $praktikum_id)
															->where('tb_detail_praktikum_asisten.status', '=', 1)
															->get(array(
																'asisten_nama',
																'tb_asisten.asisten_nim',
																'tb_detail_praktikum_asisten.no'
																));
		return View::make('dashboard.kordas.DataMaster.detailPraktikum')->with('asistens', $asistens)->with('moduls', $moduls)->with('labs', $labs)->with('praktikum', $praktikum);
		
	}

	public function storeModul (){
		$modul 	= new Modul;
		$praktikum_id			= Input::get('praktikum_id');
		$lab_id					= Input::get('lab_id');
		$input=Input::all();
		$rules=array(
			'modul_nama'=>'required'
			);
		$validation = Validator::make($input,$rules);
		if($validation->fails()){
			return Redirect::route('modul', array('lab_id' => $lab_id, 'praktikum_id' => $praktikum_id));
		}else{
			$modul->modul_nama		= Input::get('modul_nama');
			$modul->praktikum_id 	= Input::get('praktikum_id');
			$modul->save();
			return Redirect::route('modulKordas', array('lab_id' => $lab_id, 'praktikum_id' => $praktikum_id));
		}
	}

	public function updateModul (){
		$modul 				= Modul::find(Input::get('modul_id'));
		$modul->modul_nama	= Input::get('modul_nama');;
		$modul->save();
		$praktikum_id		= Input::get('praktikum_id');
		$lab_id				= Input::get('lab_id');
		return Redirect::route('modulKordas', array('lab_id' => $lab_id, 'praktikum_id' => $praktikum_id));
	}
	public function deleteModul($modul_id, $lab_id, $praktikum_id){
		$modul = Modul::find($modul_id);
		$modul->modul_status = 0;
		$modul->save();

		return Redirect::route('modulKordas', array('lab_id' => $lab_id, 'praktikum_id' => $praktikum_id));
	}

	public function storeAsistenPraktikum (){
		$praktikum_id			= Input::get('praktikum_id');
		$lab_id					= Input::get('lab_id');
		$input=Input::all();
		$rules=array(
			'asistenPrak_nim'=>'required|numeric'
			);
		$validation = Validator::make($input,$rules);
		if($validation->fails()){
			return Redirect::route('modul', array('lab_id' => $lab_id, 'praktikum_id' => $praktikum_id));
		}else{
			$checkAsisten = DB::table('tb_asisten')
								->where('lab_id', '=', $lab_id)
								->where('asisten_nim', '=', Input::get('asistenPrak_nim'))
								->pluck('asisten_nim');
			if($checkAsisten != null){
				$asistenPraktikum = new asistenPraktikum;
				$asistenPraktikum->asisten_nim = Input::get('asistenPrak_nim');
				$asistenPraktikum->praktikum_id	= Input::get('praktikum_id');
				$asistenPraktikum->save();
			}
			return Redirect::route('modulKordas', array('lab_id' => $lab_id, 'praktikum_id' => $praktikum_id));
		}	
	}

	public function deleteAsistenPraktikum ($asisten_nim, $lab_id, $praktikum_id){
		$primKey = DB::table('tb_detail_praktikum_asisten')
			->where('asisten_nim', '=', $asisten_nim)
			->pluck("no");
		$asistenPraktikum = AsistenPraktikum::find($primKey);
		$asistenPraktikum->status = 0;
		$asistenPraktikum->save();
		return Redirect::route('modulKordas', array('lab_id' => $lab_id, 'praktikum_id' => $praktikum_id));
	}
	
	/*Page Jadwal*/

	public function jadwal(){
		$jadwals 	= Jadwal::where('jadwal_status', '=', 1)->get();
		$labs 		= Lab::where('lab_status', '=', 1)->get();
		$ruangs 	= Ruang::where('ruang_status', '=', 1)->get();
		$praktikums = Praktikum::all();

		return View::make('dashboard.kordas.DataMaster.jadwal')->with('jadwals', $jadwals)->with('labs', $labs)->with('ruangs', $ruangs)->with('praktikums', $praktikums);
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
			return Redirect::to('/kordas/jadwal')
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

		return Redirect::to('/kordas/jadwal');
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
			return Redirect::to('/kordas/jadwal')
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

		return Redirect::to('/kordas/jadwal');

		}	
	}
}

?>