<?php

class AdminController extends BaseController {
	
	
	public function __construct()
    {
        $this->beforeFilter(function()
        {
            if(Session::get('role_id')!='0'){
            	return Redirect::to('login');
			}else{
				
			}
        });
    }
	
	public function showWelcome()
	{	
		return View::make('dashboard.admin.admin_index');
	}
	/*Data Master Dosen*/
	public function datamasterdosen(){
		
		$dosens =DB::table('tb_dosen')->join('tb_user', 'tb_user.user_id', '=', 'tb_dosen.user_id')->get();
		$praktikum=DB::table('tb_praktikum')->get();
		return View:: make ('dashboard.admin.DataMaster.dosen')->with(array('dosens'=>$dosens,'praktikum'=>$praktikum));
		//return View:: make ('dashboard.admin.DataMaster.dosen')->with('dosens', $dosens);
	}

	public function tambahdosen(){
		$input= Input::all();
		$rules= array(
			'dosen_nip'=>'required|min:10|numeric',
			'dosen_nama'=>'required',
			'dosen_email'=>'required|email',
			'dosen_telp'=>'required|numeric',
			'user_name'=>'required|min:6',
			'password'=>'required|min:6|alpha_num',
			'files'=>'image|max:1000'
			);
		$validation = Validator::make($input,$rules);
		if($validation->fails())
		{
			return Redirect::to('admin/datamasterdosen')->withErrors($validation);
			
		}
		else if(Input::get('password') == Input::get('confirm_password')){
			$file = Input::file('file');
			$pubpath = public_path();
			$directory = $pubpath.'/uploads/user_profpic/';
			$filename = Input::get('dosen_nip');
			$upload_success = Input::file('file')->move($directory,$filename.'.jpeg');
			if($upload_success){

				$user = new Tb_User;
				$dosen =  new Tb_Dosen;
				
				
				$user->user_name = Input::get('user_name');
				$user->password  = Hash::make(Input::get('password'));
				$user->role_id  = '5';

				$dosen->dosen_nip   =Input::get('dosen_nip');
				$dosen->dosen_nama  =Input::get('dosen_nama');
				$dosen->dosen_email =Input::get('dosen_email');
				$dosen->dosen_telp  =Input::get('dosen_telp');
				$dosen->dosen_foto  =$filename;
				$dosenchecker=DB::table('tb_user')->join('tb_dosen','tb_user.user_id','=','tb_dosen.user_id')
							  ->where('user_name','=',Input::get('user_name'))
							  ->select('tb_user.user_name','tb_dosen.dosen_nip')->first();

				//var_dump($dosenchecker);

				if($dosenchecker == null){
				$user->save();
				$user = DB::table('tb_user')->where('user_name',Input::get('user_name'))->pluck('user_id');
	
				$dosen->user_id=$user;


				$dosen->save();
				
				/*
				foreach (Input::get('praktikum_dosen') as $key => $value) {
					$praktikum = new Tb_Dosen_Praktikum;
					$praktikum->dosen_nip = Input::get('dosen_nip');
					$praktikum->praktikum_id = $value;
					$praktikum->save();
				}*/
				
				return Redirect::to('admin/datamasterdosen');
				} else{
					return Redirect::to('admin/datamasterdosen')->withErrors('Username atau NIK Dosen sudah terdafar!');
				}
			}
			
		}else{
			return Redirect::to('admin/datamasterdosen');
			
		}
	}

	public function hapusDosen($user_id){
		$dosen = Tb_Dosen::find($user_id);
		$user = Tb_User::find($user_id);
		$user->user_status =0;
		$dosen->dosen_status=0;
		$user->save();
		$dosen->save();

		return Redirect::to('admin/datamasterdosen');
	}

	public function activeDosen($user_id){
		$dosen = Tb_Dosen::find($user_id);
		$user = Tb_User::find($user_id);
		$user->user_status =1;
		$dosen->dosen_status = 1;
		$user->save();
		$dosen->save();

		return Redirect::to('admin/datamasterdosen');
	}

	public function updateDosen(){
		if(Input::get('password') == Input::get('confirm_password')){
		$user_id = Tb_User::where('user_name', Input::get('old_username'))->pluck('user_id');
		
		$dosen =  Tb_Dosen::find($user_id);
		$user = Tb_User::find($user_id);
		
		$user->user_name = Input::get('user_name');
		$user->password  = Hash::make(Input::get('password'));
		$user->save();
		
		$dosen->dosen_nip = Input::get('dosen_nip');
		$dosen->dosen_nama  =Input::get('dosen_nama');
		$dosen->dosen_email =Input::get('dosen_email');
		$dosen->dosen_telp  =Input::get('dosen_telp');
		//$dosen->dosen_foto  =$filename;

		$user = DB::table('tb_user')->where('user_name',Input::get('user_name'))->pluck('user_id');
	
		$dosen->user_id=$user;
		$dosen->save();
		return Redirect::to('admin/datamasterdosen');
		}else{
			return Redirect::to('admin/datamasterdosen');
		}
	}

	/*New Code here*/
	public function lab(){
		$labs = Lab::where('lab_status', '=', 1)->get();
		return View::make('dashboard.admin.DataMaster.lab')->with('labs', $labs);
	}

	public function store() {
		$input=Input::all();
		$rules=array(
			'lab_nama'=>'required|alpha',
			'lab_keterangan'=>'required',
			'lab_ruang'=>'required'
			);
		$validation = Validator::make($input,$rules);
		if($validation->fails())
		{
			return Redirect::to('admin/datamaster/lab')->withErrors($validation);
			
		}
		else{
			$lab 					= new Lab;
			$lab->lab_nama 			= Input::get('lab_nama');;
			$lab->lab_keterangan  	= Input::get('lab_keterangan');;
			$lab->lab_ruang  		= Input::get('lab_ruang');;
			$lab->save();
			return Redirect::to('admin/datamaster/lab');
		}
	}

	public function updateLab() {
		$lab 					= Lab::find(Input::get('lab_id'));
		$lab->lab_nama 			= Input::get('lab_nama');;
		$lab->lab_keterangan 	= Input::get('lab_keterangan');;
		$lab->lab_ruang 		= Input::get('lab_ruang');;
		$lab->save();

		return Redirect::to('admin/datamaster/lab');
	}

	public function deleteLab($lab_id) {
		$lab = Lab::find($lab_id);
		$lab->lab_status = 0;
		$lab->save();

		return Redirect::to('admin/datamaster/lab');	
	}
	/*public function delete($lab_id) {
		$praktikum 				= DB::table('tb_praktikum')->where('lab_id', '=', $lab_id)->delete();
		$detail_lab_asisten 	= DB::table('tb_detail_lab_asisten')->where('lab_id', '=', $lab_id)->delete();
		$asisten 				= DB::table('tb_asisten')->where('lab_id', '=', $lab_id)->delete();
		$lab 					= Lab::find($lab_id);
		$lab-> delete();
		return 	Redirect::to('lab');
	}*/

	public function praktikum($lab_id) {
		$praktikums = Praktikum::where('lab_id', '=', $lab_id)->where('praktikum_status', '=', 1)->get();
		$labs 		= Lab::find($lab_id);
		return View::make('dashboard.admin.DataMaster.praktikum')->with('praktikums', $praktikums)->with('labs', $labs);
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
			return Redirect::route('praktikum', ['lab_id' =>  $lab_id]);
		}
	}

	public function updatePraktikum() {
		$praktikum 							= Praktikum::find(Input::get('praktikum_id'));
		$praktikum->praktikum_nama 			= Input::get('praktikum_nama');;
		$praktikum->praktikum_keterangan 	= Input::get('praktikum_keterangan');;
		$praktikum->save();
		$lab_id								= Input::get('lab_id');

		return Redirect::route('praktikum', ['lab_id' =>  $lab_id]);
	}

	public function deletePraktikum($praktikum_id, $lab_id) {
		$praktikum = Praktikum::find($praktikum_id);
		$praktikum->praktikum_status = 0;
		$praktikum->save();

		return Redirect::route('praktikum', ['lab_id' =>  $lab_id]);
	}

	public function asisten($lab_id) {
		$asistens 	= Asisten::where('lab_id', '=', $lab_id)->where('asisten_status', '=', 1)->get();
		$labs 		= Lab::find($lab_id);

		return View::make('dashboard.admin.DataMaster.asisten')->with('asistens', $asistens)->with('labs', $labs);
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
			return Redirect::route('asisten', ['lab_id' =>  $lab_id]);
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

			return Redirect::route('asisten', ['lab_id' =>  $lab_id]);
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

		return Redirect::route('asisten', ['lab_id' =>  $lab_id]);
	}

	public function deleteAsisten($asisten_nim, $lab_id) {
		$asisten = Asisten::find($asisten_nim);
		$asisten->asisten_status = 0;
		$asisten-> save();

		return Redirect::route('asisten', ['lab_id' =>  $lab_id]);
	}

	public function detailPraktikum($lab_id, $praktikum_id){
		$labs 		= Lab::find($lab_id);
		$praktikum  = Praktikum::find($praktikum_id);
		$moduls		= DB::table('tb_modul')->where('praktikum_id', '=', $praktikum_id)->where('modul_status','=',1)->get();
		$asistens	= DB::table('tb_detail_praktikum_asisten')
															->join('tb_asisten', 'tb_asisten.asisten_nim', '=', 'tb_detail_praktikum_asisten.asisten_nim')
															->where('praktikum_id', '=', $praktikum_id)
															->where('tb_detail_praktikum_asisten.status', '=', 1)
															->get(array(
																'asisten_nama',
																'tb_asisten.asisten_nim',
																'tb_detail_praktikum_asisten.no'
																));
		return View::make('dashboard.admin.DataMaster.detailPraktikum')->with('asistens', $asistens)->with('moduls', $moduls)->with('labs', $labs)->with('praktikum', $praktikum);
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
			return Redirect::route('modul', array('lab_id' => $lab_id, 'praktikum_id' => $praktikum_id));
		}
	}

	public function updateModul (){
		$modul 				= Modul::find(Input::get('modul_id'));
		$modul->modul_nama	= Input::get('modul_nama');;
		$modul->save();
		$praktikum_id		= Input::get('praktikum_id');
		$lab_id				= Input::get('lab_id');
		return Redirect::route('modul', array('lab_id' => $lab_id, 'praktikum_id' => $praktikum_id));
	}
	public function deleteModul($modul_id, $lab_id, $praktikum_id){
		$modul = Modul::find($modul_id);
		$modul->modul_status = 0;
		$modul->save();

		return Redirect::route('modul', array('lab_id' => $lab_id, 'praktikum_id' => $praktikum_id));
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
			return Redirect::route('modul', array('lab_id' => $lab_id, 'praktikum_id' => $praktikum_id));
		}	
	}
	public function updateAsistenPraktikum (){
		$asisten_nim = Input::get('asistenPrak_nim');
		$primKeyAsprak = Input::get('primKeyAsprak');
		DB::table('tb_detail_praktikum_asisten')
            ->where('no', $primKeyAsprak)
            ->update(array('asisten_nim' => $asisten_nim));

		$praktikum_id		= Input::get('praktikum_id');
		$lab_id				= Input::get('lab_id');
		return Redirect::route('modul', array('lab_id' => $lab_id, 'praktikum_id' => $praktikum_id));
	}
	public function deleteAsistenPraktikum ($asisten_nim, $lab_id, $praktikum_id){
		$primKey = DB::table('tb_detail_praktikum_asisten')
			->where('asisten_nim', '=', $asisten_nim)
			->pluck("no");
		$asistenPraktikum = AsistenPraktikum::find($primKey);
		$asistenPraktikum->status = 0;
		$asistenPraktikum->save();
		return Redirect::route('modul', array('lab_id' => $lab_id, 'praktikum_id' => $praktikum_id));
	}
	
	/* PRAKTIKUM START HERE */
	public function listSoalPraktikum($lab_id, $praktikum_id, $modul_id){
		$labs 		= Lab::find($lab_id);
		$praktikum  = Praktikum::find($praktikum_id);
		$moduls		= Modul::find($modul_id);
		$quizs		= DB::table('tb_quiz')->where('modul_id', '=', $modul_id)->get();
		
		return View::make('dashboard.admin.Praktikum.listsoal')->with('moduls', $moduls)->with('labs', $labs)->with('praktikum', $praktikum)->with('quizs',$quizs);
	}
	
	public function storeQuiz() {
		$lab_id			= Input::get('lab_id');
		$praktikum_id	= Input::get('praktikum_id');
		$modul_id		= Input::get('modul_id');
		$quiz 			= new Quiz;
		$quiz			->quiz_nama = Input::get('quiz_nama');
		$quiz			->quiz_keterangan = Input::get('quiz_keterangan');
		$quiz			->quiz_intro = Input::get('quiz_intro');
		$quiz			->modul_id = Input::get('modul_id');	
		$quiz			->quiz_durasi = Input::get('quiz_durasi');
		$quiz			->save();		
		return Redirect::to('lab/'.$lab_id.'/praktikum/'.$praktikum_id.'/modul/'.$modul_id.'/listsoal');
	}
	
	public function deleteQuiz($lab_id, $praktikum_id, $modul_id, $quiz_id ) {
		
		$quiz	= Quiz::find($quiz_id);
		$quiz	->delete();
		return Redirect::to('lab/'.$lab_id.'/praktikum/'.$praktikum_id.'/modul/'.$modul_id.'/listsoal');
	}
	
	public function listDetailSoalPraktikum($lab_id, $praktikum_id, $modul_id, $quiz_id){
		$labs 		= Lab::find($lab_id);
		$praktikum  = Praktikum::find($praktikum_id);
		$moduls		= Modul::find($modul_id);
		$quizs		= Quiz::find($quiz_id);
		$soals		= DB::table('tb_soal')->where('quiz_id','=', $quiz_id)->get();
		return View::make('dashboard.admin.Praktikum.soalDetail')->with('moduls', $moduls)->with('labs', $labs)->with('praktikum', $praktikum)->with('quizs', $quizs)->with('soals',$soals);
	}
	
	public function storeSoal() {
		$lab_id			= Input::get('lab_id');
		$praktikum_id	= Input::get('praktikum_id');
		$modul_id		= Input::get('modul_id');
		$soal 			= new Soal;
		$soal			->soal_text = Input::get('soal_text');
		$soal			->soal_point = Input::get('soal_point');
		$soal			->soal_type = Input::get('soal_type');		
		$soal			->quiz_id = Input::get('quiz_id');	
		$soal			->save();		
		
		
		$soals = DB::table('tb_soal')
                    ->orderBy('soal_id', 'desc')                    
                    ->first();
		
		if(Input::get('soal_type')==1){
							
			$jawaban			= new Jawaban;
			$jawaban			->jawaban_text = Input::get('pilihanA');
			$jawaban			->jawaban_benar = Input::get('kunciSoalA');
			$jawaban			->soal_id = $soals->soal_id;
			$jawaban			->save();
			
			$jawaban			= new Jawaban;
			$jawaban			->jawaban_text = Input::get('pilihanB');
			$jawaban			->jawaban_benar = Input::get('kunciSoalB');
			$jawaban			->soal_id = $soals->soal_id;
			$jawaban			->save();
			
			$jawaban			= new Jawaban;
			$jawaban			->jawaban_text = Input::get('pilihanC');
			$jawaban			->jawaban_benar = Input::get('kunciSoalC');
			$jawaban			->soal_id = $soals->soal_id;
			$jawaban			->save();
			
			$jawaban			= new Jawaban;
			$jawaban			->jawaban_text = Input::get('pilihanD');
			$jawaban			->jawaban_benar = Input::get('kunciSoalD');
			$jawaban			->soal_id = $soals->soal_id;
			$jawaban			->save();
			
			$jawaban			= new Jawaban;
			$jawaban			->jawaban_text = Input::get('pilihanE');
			$jawaban			->jawaban_benar = Input::get('kunciSoalE');
			$jawaban			->soal_id = $soals->soal_id;
			$jawaban			->save();
			
		}else{
			
			$jawaban			= new Jawaban;
			$jawaban			->jawaban_text = Input::get('jawaban');
			$jawaban			->jawaban_benar = 'true';
			$jawaban			->soal_id = $soals->soal_id;
			$jawaban			->save();	
		}
		
		return Redirect::to('lab/'.$lab_id.'/praktikum/'.$praktikum_id.'/modul/'.$modul_id.'/listsoal/'.$soal_id);
	}
	
	
	public function storeJawaban($jawaban_text, $jawaban_benar, $soal_id){		
		$jawaban			= new Jawaban;
		$jawaban			->jawaban_text = $jawaban_text;
		$jawaban			->jawaban_benar = $jawaban_benar;
		$jawaban			->soal_id = $soal_id;
		$jawaban			->save();				
	}
	
	//PLAY
	public function praktikumPra(){			
		$praktikum		= DB::table('tb_lab')->join('tb_praktikum','tb_praktikum.lab_id','=', 'tb_lab.lab_id')->select('tb_praktikum.praktikum_id', 'tb_praktikum.praktikum_nama','tb_lab.lab_nama')->get();		
		return View::make('dashboard.admin.Praktikum.praktikumPraPlay')->with('praktikum', $praktikum) ;
	}
	public function praktikumPraDetail($praktikum_id){		
		$modul		= DB::table('tb_modul')->where('praktikum_id', $praktikum_id)->select('tb_modul.modul_id','tb_modul.modul_nama')->get();
		$jadwal 	= DB::table('tb_jadwal')->join('tb_ruang','tb_jadwal.ruangan_id','=','tb_ruang.ruang_id')->where('praktikum_id', $praktikum_id)->select('tb_jadwal.jadwal_id', 'tb_jadwal.jadwal_nama', 'tb_jadwal.jadwal_jam_mulai','tb_jadwal.jadwal_jam_selesai','tb_jadwal.jadwal_hari','tb_ruang.ruang_nama')->get();
		$jumlah		= DB::table('tb_jadwal')->join('tb_detail_jadwal_praktikan','tb_jadwal.jadwal_id','=','tb_detail_jadwal_praktikan.jadwal_id')->count();
		$praktikum	= Praktikum::find($praktikum_id);
		
		$data 		= DB::table('tb_running')->join('tb_modul','tb_modul.modul_id','=','tb_running.modul_id')->join('tb_praktikum','tb_praktikum.praktikum_id','=','tb_modul.praktikum_id')->join('tb_jadwal','tb_jadwal.jadwal_id','=','tb_running.jadwal_id')->where('tb_modul.praktikum_id','=',$praktikum_id)->select('tb_running.running_start','tb_running.running_id','tb_running.running_end','tb_running.running_duration', 'tb_modul.modul_nama','tb_praktikum.praktikum_nama','tb_jadwal.jadwal_hari','tb_jadwal.jadwal_jam_mulai','tb_jadwal.jadwal_nama')->get();
		
		return View::make('dashboard.admin.Praktikum.praktikumPraPlayDetail')->with('modul',$modul)->with('jadwal', $jadwal)->with('jumlah', $jumlah)->with('praktikum',$praktikum)->with('data',$data);
	}
	public function storeRunning(){		
		$durasi = Input::get('running_duration');			
		
		$dtStart = date("Y-m-d H:i:s",time() );
		$dtEnd = date("Y-m-d H:i:s",time() + (($durasi*60)));
		
		$run			= new Running;
		$run			->running_start = $dtStart;
		$run			->running_end = $dtEnd;
		$run			->running_duration = Input::get('running_duration');
		$run			->jadwal_id = Input::get('jadwal_id'); 
		$run			->modul_id = Input::get('modul_id'); 
		$user_name 		= Session::get('user_name');
		$user			=DB::table('tb_user')->where('user_name','=', $user_name)->first();
		$run			->user_id = $user->user_id;
		$run			->save();
		$praktikum = Input::get('praktikum_id');
		return Redirect::to('praktikum/pra/'.$praktikum);
	}
	





	/*Manage Ruangan*/
	public function ruang(){
		$ruangs = Ruang::where('ruang_status', '=', 1)->get();
		return View::make('dashboard.admin.DataMaster.ruang')->with('ruangs', $ruangs);
	}

	public function deleteRuang($ruang_id) {
		$ruang = Ruang::find($ruang_id);
		$ruang->ruang_status = 0;
		$ruang->save();

		return Redirect::to('/admin/ruang');	
	}

	public function storeRuang() {
		$rules = array(
			'ruang_nama' => 'required',
			'ruang_quota' => 'required|numeric',
			'ruang_keterangan' => 'required'
		);
		$validator = Validator::make(Input::all(), $rules);

		if ($validator->fails()) {
			return Redirect::to('/admin/ruang')
				->withErrors($validator);

		} else {
		$ruang 						= new Ruang;
		$ruang->ruang_nama 			= Input::get('ruang_nama');;
		$ruang->ruang_quota  		= Input::get('ruang_quota');;
		$ruang->ruang_keterangan  	= Input::get('ruang_keterangan');;
		$ruang->save();

		return Redirect::to('/admin/ruang');
		}
	}

	public function updateRuang() {
		$rules = array(
			'ruang_nama' => 'required',
			'ruang_quota' => 'required|numeric',
			'ruang_keterangan' => 'required'
		);
		$validator = Validator::make(Input::all(), $rules);

		if ($validator->fails()) {
			return Redirect::to('/admin/ruang')
				->withErrors($validator);
				
		} else {
		$ruang 						= Ruang::find(Input::get('ruang_id'));
		$ruang->ruang_nama 			= Input::get('ruang_nama');;
		$ruang->ruang_quota 		= Input::get('ruang_quota');;
		$ruang->ruang_keterangan 	= Input::get('ruang_keterangan');;
		$ruang->save();

		return Redirect::to('/admin/ruang');	
		}
	}

	/*Page Jadwal*/

	public function jadwal(){
		$jadwals 	= Jadwal::where('jadwal_status', '=', 1)->get();
		$labs 		= Lab::where('lab_status', '=', 1)->get();
		$ruangs 	= Ruang::where('ruang_status', '=', 1)->get();
		$praktikums = Praktikum::all();

		return View::make('dashboard.admin.DataMaster.jadwal')->with('jadwals', $jadwals)->with('labs', $labs)->with('ruangs', $ruangs)->with('praktikums', $praktikums);
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
			return Redirect::to('/admin/jadwal')
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

		return Redirect::to('/admin/jadwal');
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
			return Redirect::to('/admin/jadwal')
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

		return Redirect::to('/admin/jadwal');
		}	
	}

	public function upload(){
		$items = Item::where('item_status', '=', 1)->get();
		return View::make('dashboard.admin.DataMaster.upload')->with('items', $items);;
	}

	public function result(){
		
		return View::make('dashboard.admin.DataMaster.result');
	}

	public function uploadFile(){
		$file = Input::file('berkas');
		$input=Input::all();

		$rules=array(
			'berkas' => 'mimes:zip|max:10000',
			);

		$validation = Validator::make($input,$rules);
		if($validation->fails())
		{
			//Upload Gagal
			return Redirect::to('upload')->withErrors($validation);
			
		}

		

		$pubpath = public_path();
		$directory = $pubpath.'\barangmu';

		$largestNumberID = DB::table('tb_item')->max('item_id');
		$item_id = $largestNumberID+1;

		$filename = $file->getClientOriginalName();
		//$filenamefix = $item_id.$filename;
		$filenamefix = md5($filename.$item_id).".zip";

		//$fileSize = $file->getSize();
		$fileExt = $file->getClientOriginalExtension();

		$upload_status = Input::file('berkas')->move($directory,$filenamefix);

		if($upload_status){

				$user_id = 12;

				//$item_kode = md5($filename.$item_id);

				$item 							= new Item;
				$item->item_id					= $item_id;
				$item->user_id 					= $user_id;
				$item->item_nama 				= $filename;	
				$item->item_kode 				= $filenamefix;
				$item->save();

				//Upload Berhasil
				return Redirect::to('upload');

			
		}else{
			//Upload Gagal
			return Redirect::to('upload');
		}

			
	}
}

?>