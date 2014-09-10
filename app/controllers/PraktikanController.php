<?php

class PraktikanController extends BaseController {
	public function __construct()
    {
        $this->beforeFilter(function()
        {
            if(Session::get('role_id')!='4'){
				return View::make('login');
			}else{
				
			}
        });
    }
	
	public function cekUser(){
		$user_name 		= Session::get('user_name');
		$user			= DB::table('tb_user')->where('user_name','=', $user_name)->select('user_id')->first();
		return $user->user_id;
	}
	
	public function showWelcome()
	{
		
		$data = DB::table('view_datajadwal')->get();
			
		$user_name 		= Session::get('user_name');
		$user			= DB::table('tb_user')->where('user_name','=', $user_name)->first();
		
		$jadwal = DB::table('tb_user')
			->join('tb_praktikan', 'tb_user.user_id', '=', 'tb_praktikan.user_id')
			->join('tb_detail_jadwal_praktikan', 'tb_detail_jadwal_praktikan.praktikan_nim', '=', 'tb_praktikan.praktikan_nim')
			->join('tb_jadwal', 'tb_detail_jadwal_praktikan.jadwal_id', '=', 'tb_jadwal.jadwal_id')			
			->join('tb_praktikum', 'tb_praktikum.praktikum_id', '=', 'tb_jadwal.praktikum_id')
			->select('tb_praktikum.praktikum_id', 'tb_praktikum.praktikum_nama','tb_jadwal.jadwal_jam_mulai','tb_jadwal.jadwal_hari', 'tb_jadwal.jadwal_jam_selesai')
			->where('tb_user.user_id','=',$this->cekUser())
			->get();
		return View::make('dashboard.praktikan.praktikan_index')->with('data', $data)->with('jadwal', $jadwal);
		
		//return View::make('dashboard.praktikan.praktikum.praktikumEnd');
	}

	public function praktikumList($running_id)
	{	
		$run = DB::table('tb_running')
			->join('tb_modul','tb_running.modul_id','=','tb_modul.modul_id')
			->join('tb_praktikum','tb_modul.praktikum_id','=','tb_praktikum.praktikum_id')
			->join('tb_quiz','tb_modul.modul_id','=','tb_quiz.modul_id')
			->select('tb_running.running_id','tb_running.running_end', 'tb_running.running_duration','tb_praktikum.praktikum_nama','tb_praktikum.praktikum_id','tb_modul.modul_id','tb_modul.modul_nama','tb_quiz.quiz_id','tb_quiz.quiz_nama','tb_quiz.quiz_durasi')
			->where('tb_running.running_id','=',$running_id)
			->get();
		
		$cek = DB::table('tb_kunci_quiz')
			->where('user_id','=',$this->cekUser())
			->select('quiz_id','kunci_quiz_status','kunci_quiz_start','kunci_quiz_end','user_id','running_id')
			->get();
		return View::make('dashboard.praktikan.praktikum.praktikumList')->with('run',$run)->with('cek',$cek);
		
	}
	
	public function praktikumSoal($running_id, $quiz_id, $nomor)
	{			
	
		$soal = DB::table('view_dataSoal')->where('running_id','=', $running_id)->where('quiz_id','=', $quiz_id)->get();
		$jawaban = DB::table('tb_jawaban')->join('tb_soal','tb_soal.soal_id','=','tb_jawaban.soal_id')->where('quiz_id', '=', $quiz_id)->select('tb_jawaban.jawaban_id','tb_jawaban.jawaban_text','tb_soal.soal_id')->get();
		$run = $running_id;
		$quiz = $quiz_id;
		$no = $nomor;
		
		$cekData=DB::table('tb_jawaban_user')
		->join('tb_soal','tb_soal.soal_id','=','tb_jawaban_user.soal_id')
		->where('tb_jawaban_user.user_id','=',$this->cekUser())
		->where('tb_soal.quiz_id','=',$quiz_id)
		->select('tb_jawaban_user.jawaban_user_id')->first();
		
		$ambilDurasi=DB::table('tb_quiz')
		->where('quiz_id','=',$quiz)
		->select('quiz_durasi')
		->first();
		
		
		
		
		//var_dump($cekData);
		
		
				
		if($cekData == null){		
			foreach($soal as $so){		
			 $this->inputJawabStart($so->soal_id, $this->cekUser());
			}
			$dtStart = date("Y-m-d H:i:s",time() );
			$dtEnd = date("Y-m-d H:i:s",time() + ($ambilDurasi->quiz_durasi*60));
							
			$inputTimeStart = new bukaQuiz;
			$inputTimeStart -> buka_quiz_start = $dtStart;
			$inputTimeStart -> buka_quiz_end = $dtEnd;
			$inputTimeStart -> user_id = $this->cekUser();
			$inputTimeStart -> quiz_id = $quiz;
			$inputTimeStart -> buka_quiz_durasi = $ambilDurasi->quiz_durasi;
			$inputTimeStart -> buka_quiz_status = 0;
			$inputTimeStart -> save();
			
		}
		
		
			
		
		$getTimer = DB::table('tb_buka_quiz')
		->where('user_id','=',$this->cekUser())
		->where('quiz_id','=',$quiz)
		->select('quiz_id','buka_quiz_end','buka_quiz_durasi')
		->first();
		
		$getJawaban = DB::table('tb_jawaban_user')
				->where('soal_id','=',$nomor)
				->where('user_id','=',$this->cekUser())
				->select('jawaban_id','jawaban_user_text','soal_id')->first();
				
		return View::make('dashboard.praktikan.praktikum.praktikumStart')->with('soal',$soal)->with('jawaban',$jawaban)->with('run',$run)->with('quiz',$quiz)->with('no',$no)->with('getJawaban',$getJawaban)->with('getTimer', $getTimer);
		
	}
	//input PILGAN
	public function updateJawaban1(){
		$jawaban_id = explode('-',Input::get('jawab'))[0];
		$jawaban_text = explode('-',Input::get('jawab'))[1];
		$point = 0;
		$getPoint = DB::table('tb_jawaban')
		->join('tb_soal','tb_jawaban.soal_id','=','tb_soal.soal_id')
		->where('tb_soal.soal_id','=',Input::get('soal_id'))
		->select('jawaban_benar','soal_point')->first();
		if($getPoint->jawaban_benar == $jawaban_text){
			$point = $getPoint->soal_point;
		}else{	
			$point = 0;
		}
		
		$this->updateJawab(Input::get('soal_id'), $this->cekUser(), $jawaban_text, $jawaban_id, $point);
		
		
		
//		$kunci = DB::table
		return Redirect::to(Input::get('link'));
	}
	//INPUT ESSAY
	public function updateJawaban2(){
		
		$this->updateJawab(Input::get('soal_id'), $this->cekUser(), Input::get('jawaban'), 0, 0);
		
//		$kunci = DB::table
		return Redirect::to(Input::get('link'));
	}
	//INPUT UPLOAD
	public function updateJawaban3(){
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
		$directory = $pubpath.'\upload_jawab';

		$filename = $file->getClientOriginalName();
		//$filenamefix = $item_id.$filename;
		$filenamefix = md5($filename."jawaban")."zip";

		$fileSize = $file->getSize();
		$fileExt = $file->getClientOriginalExtension();

		$upload_status = Input::file('berkas')->move($directory,$filenamefix);

		if($upload_status){
				//Upload Berhasil
				return View::make('dashboard.admin.DataMaster.result')->with('item_ids', $item_id);
				
				$this->updateJawab(Input::get('soal_id'), $this->cekUser(), $filenamefix, 0, 0);				
				return Redirect::to(Input::get('link'));
			
		}else{
			//Upload Gagal
			return Redirect::to(Input::get('link'));
		}

			
	}
	public function inputJawabStart($soal_id, $user_id){
		$JU 					= new JawabanUser;		
		$JU->soal_id  			= $soal_id;
		$JU->user_id  			= $user_id;
		$JU->save();		
	}
	public function updateJawab($soal_id, $user_id, $jawaban_user_text, $jawaban_id , $point){
		DB::table('tb_jawaban_user')	
		->where('soal_id','=',$soal_id)
		->where('user_id','=',$user_id)
		->update(array('jawaban_user_text' => $jawaban_user_text , 'jawaban_id' => $jawaban_id , 'jawaban_user_point' => $point));
	}
	
	public function registrasipraktikum(){
		$nim = DB::table('tb_user')
				->join('tb_praktikan', 'tb_user.user_id', '=', 'tb_praktikan.user_id')
				->where('user_name', Session::get('user_name'))
				->select('tb_praktikan.praktikan_nim')->first();

		$data = DB::table('view_register_praktikum')
				->where('praktikan_nim', $nim->praktikan_nim)->get();

		return View::make ('dashboard.praktikan.praktikan_registrasi_praktikum')->with('datas', $data);
	}

	public  function pilihpraktikum(){
		$list_lab = DB::table('tb_lab')->get();
		$list_praktikum;

		$praktikan_nim = DB::table('tb_user')
							->join('tb_praktikan', 'tb_user.user_id', '=', 'tb_praktikan.user_id')
							->where('tb_user.user_name', Session::get('user_name'))
							->pluck('praktikan_nim');

		$praktikumKu = DB::table('view_register_praktikum')
				->where('praktikan_nim', $praktikan_nim)->get();

		foreach ($list_lab as $key => $value) {
			if(empty($praktikumKu)){
				$list_praktikum[$key] = DB::table('tb_praktikum')
									->join('tb_lab', 'tb_praktikum.lab_id', '=', 'tb_lab.lab_id')
									->where('tb_lab.lab_id', $value->lab_id)
									->get();
			}else{
				$list_praktikum[$key] = DB::table('tb_praktikum')
									->join('tb_lab', 'tb_praktikum.lab_id', '=', 'tb_lab.lab_id')
									->where('tb_lab.lab_id', $value->lab_id)
									->whereNotIn('praktikum_id', array_pluck($praktikumKu, 'praktikum_id'))
									->get();
			}
		}
		
		return View::make('dashboard.praktikan.praktikan_registrasi_tambah_praktikum')
				->with('list_praktikum', $list_praktikum);
	}

	public function pilihjadwal(){

		$listTime = array(
					new DateTime('06:30'),
					new DateTime('08.30'),
					new DateTime('10.30'),
					new DateTime('12.30'),
					new DateTime('14.30'),
					new DateTime('16.30'),
					new DateTime('18.30')
					);

		$praktikum_id = Input::get('praktikum_id');

		$praktikan_nim = DB::table('view_user_praktikan')
							->where('user_name', Session::get('user_name'))
							->pluck('praktikan_nim');

		$checkJadwal = DB::table('view_register_praktikum')
							->where('praktikan_nim', $praktikan_nim)
							->where('praktikum_id', $praktikum_id)
							->get();

		if(!(empty($checkJadwal))){
			return Redirect::to('/praktikan/RegisterPraktikum')->with('error', 'Praktikum Telah Terpilih');
		}

		$listJadwal = DB::table('tb_jadwal')
						->join('tb_praktikum', 'tb_jadwal.praktikum_id', '=', 'tb_praktikum.praktikum_id')
						->join('tb_ruang', 'tb_jadwal.ruangan_id', '=', 'tb_ruang.ruang_id')
						->where('tb_praktikum.praktikum_id', $praktikum_id)
						->get();

		for($i = 0; $i<7; $i++){
			for($j = 0; $j<7; $j++){
				if($j==0)
					$tableJadwal[$i][$j] = '<th style="text-align:center;">'.$listTime[$i]->format('H.i').'</th>';
				else
					$tableJadwal[$i][$j] = '<td></td>';
			}
		}

		foreach ($listJadwal as $jadwal) {
			$sisaQuota = DB::table('tb_detail_jadwal_praktikan')
							->select(DB::raw('COUNT(*) as jumlah'))
							->where('jadwal_id', $jadwal->jadwal_id)
							->pluck('jumlah');

			$quota = $jadwal->ruang_quota - $sisaQuota;

			$tableJadwal[$jadwal->jadwal_shift-1][$jadwal->jadwal_hari] = '<td style="text-align:center;
															background:#1FB5AD;
															color:#FFFFFF;
															font-size:85%;">'.$jadwal->praktikum_nama.
															' | '.$quota.' Orang<br>
															<a href="submitJadwal?praktikum_id='.$jadwal->praktikum_id.
															'&jadwal_id='.$jadwal->jadwal_id.'">Pilih</a></td>';
		}
		
		return View::make ('dashboard.praktikan.praktikan_registrasi_pilih_jadwal')
					->with('listJadwal', $tableJadwal);
	}

	public function submitJadwal()
	{
		$praktikum_id = Input::get('praktikum_id');
		$jadwal_id = Input::get('jadwal_id');

		$praktikan_nim = DB::table('view_user_praktikan')
							->where('user_name', Session::get('user_name'))
							->pluck('praktikan_nim');

		$valid = DB::table('tb_jadwal')
					->where('jadwal_id', $jadwal_id)
					->where('praktikum_id', $praktikum_id)
					->get();

		if(empty($valid)){
			return Redirect::to('/praktikan/RegisterPraktikum')->with('error', 'Data praktikum tidak valid');
		}

		$myPraktikum = DB::table('tb_detail_jadwal_praktikan')
					->join('tb_jadwal', 'tb_detail_jadwal_praktikan.jadwal_id', '=', 'tb_jadwal.jadwal_id')
					->where('praktikan_nim', $praktikan_nim)
					->get();

		if(in_array($praktikum_id, array_pluck($myPraktikum, 'praktikum_id'))){
			return Redirect::to('/praktikan/RegisterPraktikum')->with('error', 'Praktikum telah dipilih');
		}

		$quota = DB::table('tb_jadwal')
					->join('tb_ruang', 'tb_jadwal.ruangan_id', '=', 'tb_ruang.ruang_id')
					->where('tb_jadwal.jadwal_id', $jadwal_id)
					->first();

		$terisi = DB::table('tb_detail_jadwal_praktikan')
					->select(DB::raw('COUNT(*) as jumlah'))
					->where('jadwal_id', $jadwal_id)
					->first();

		if($terisi->jumlah + 1 > $quota->ruang_quota){
			return Redirect::to('/praktikan/RegisterPraktikum')->with('error', 'Jadwal penuh');
		}

		$tb_detail_jadwal_praktikan = new Tb_Detail_Jadwal_Praktikan();

		$tb_detail_jadwal_praktikan->praktikan_nim = $praktikan_nim;
		$tb_detail_jadwal_praktikan->jadwal_id = $jadwal_id;
		$tb_detail_jadwal_praktikan->save();
		
		return Redirect::to('/praktikan/RegisterPraktikum')->with('success', 'Data tersimpan');
	}


	public function hapuspraktikum(){
		$jadwal_id = Input::get('id');

		$praktikan_nim = DB::table('view_user_praktikan')
							->where('user_name', Session::get('user_name'))
							->pluck('praktikan_nim');

		$hapuspraktikum_user = DB::table('tb_detail_jadwal_praktikan')
								->where('jadwal_id',$jadwal_id)
								->where('praktikan_nim',$praktikan_nim)
								->delete();

		//$tb_detail_jadwal_praktikan->delete();
								//var_dump($hapuspraktikum_user);
		return Redirect::to('/praktikan/RegisterPraktikum')->with('success', 'Data Praktikum Berhasil Terhapus');
		


	}

}

?>