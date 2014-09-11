<?php

class AsistenController extends BaseController {
	public function __construct()
    {
        $this->beforeFilter(function()
        {
            if(Session::get('role_id')!='3'){
				return View::make('login');
			}else{
				
			}
        });
    }
	public function showWelcome()
	{
		return View::make('dashboard.asisten.asisten_index');
	}

	public function showAbsensi()
	{
		$asisten = DB::table('view_user_asisten')
						->join('tb_lab', 'view_user_asisten.lab_id', '=', 'tb_lab.lab_id')
						->where('user_name', Session::get('user_name'))
						->select('asisten_nim', 'lab_nama')->first();

		$listPraktikum = DB::table('tb_detail_praktikum_asisten')
							->join('tb_praktikum', 'tb_detail_praktikum_asisten.praktikum_id', '=', 'tb_praktikum.praktikum_id')
							->join('tb_lab', 'tb_lab.lab_id', '=', 'tb_praktikum.lab_id')
							->where('asisten_nim', $asisten->asisten_nim)
							->get();

		if(empty($listPraktikum)){
			return View::make('absensi.listjadwal')->with('error', "Anda tidak memiliki jadwal praktikum");
		}

		foreach ($listPraktikum as $praktikum) {
			$modul = DB::table('tb_modul')
						->select(DB::raw('COUNT(*) jumlah'))
						->where('praktikum_id', $praktikum->praktikum_id)
						->pluck('jumlah');

			$praktikum->totalModul = $modul;

			$peserta = DB::table('tb_jadwal')
						->join('tb_detail_jadwal_praktikan', 'tb_jadwal.jadwal_id', '=', 'tb_detail_jadwal_praktikan.jadwal_id')
						->select(DB::raw('COUNT(*) as jumlah'))
						->where('tb_jadwal.praktikum_id', $praktikum->praktikum_id)
						->pluck('jumlah');

			$praktikum->totalPeserta = $peserta;
		}
		
		return View::make('absensi.listjadwal')->with(array('asisten' => $asisten, 'listPraktikum' => $listPraktikum)); 
	}

	public function showShift()
	{
		$listHari = array("Senin", "Selasa", 'Rabu', "Kamis", "Jum'at", "Sabtu");

		$praktikum_id = Input::get('id');

		$asisten_nim = DB::table('view_user_asisten')
						->join('tb_lab', 'view_user_asisten.lab_id', '=', 'tb_lab.lab_id')
						->where('user_name', Session::get('user_name'))
						->pluck('asisten_nim');

		$valid = DB::table('tb_detail_praktikum_asisten')
					->where('asisten_nim', $asisten_nim)
					->where('praktikum_id', $praktikum_id)
					->get();

		if(empty($valid))
		{
			return Redirect::to('asisten/jadwal')->with('error', 'Anda tidak memiliki hak untuk mengakses praktikum ini.');
		}

		$listJadwal = DB::table('tb_jadwal')
						->join('tb_praktikum', 'tb_jadwal.praktikum_id', '=', 'tb_praktikum.praktikum_id')
						->where('tb_praktikum.praktikum_id', $praktikum_id)
						->select('tb_praktikum.praktikum_nama', 
								'tb_jadwal.jadwal_hari', 
								'tb_jadwal.jadwal_id', 
								'tb_jadwal.jadwal_shift',
								'tb_jadwal.jadwal_jam_mulai',
								'tb_jadwal.jadwal_jam_selesai')
						->get();

		foreach ($listJadwal as $jadwal) {
			$jumlah = DB::table('tb_detail_jadwal_praktikan')
						->select(DB::raw('COUNT(*) as jumlah'))
						->where('jadwal_id', $jadwal->jadwal_id)
						->pluck('jumlah');

			$jadwal->hari = $listHari[$jadwal->jadwal_hari - 1];
			$jadwal->jumlah = $jumlah;
		}

		return View::make('absensi.listshift')->with('listJadwal', $listJadwal);
	}

	public function showModul()
	{
		$listHari = array("Senin", "Selasa", 'Rabu', "Kamis", "Jum'at", "Sabtu");

		$jadwal_id = Input::get('jadwal');

		$asisten_nim = DB::table('view_user_asisten')
						->join('tb_lab', 'view_user_asisten.lab_id', '=', 'tb_lab.lab_id')
						->where('user_name', Session::get('user_name'))
						->pluck('asisten_nim');

		$valid = DB::table('tb_detail_praktikum_asisten')
					->join('tb_jadwal', 'tb_detail_praktikum_asisten.praktikum_id', '=', 'tb_jadwal.praktikum_id')
					->where('jadwal_id', $jadwal_id)
					->where('asisten_nim', $asisten_nim)->get();

		if(empty($valid))
		{
			return Redirect::to('asisten/jadwal')->with('error', 'Anda tidak memiliki hak untuk mengakses praktikum ini.');
		}

		$listModul = DB::table('tb_modul')
					->join('tb_praktikum', 'tb_modul.praktikum_id', '=', 'tb_praktikum.praktikum_id')
					->join('tb_jadwal', 'tb_praktikum.praktikum_id', '=', 'tb_jadwal.praktikum_id')
					->select('tb_praktikum.praktikum_nama', 
							'tb_modul.modul_nama', 
							'tb_jadwal.jadwal_hari', 
							'tb_jadwal.jadwal_shift', 
							'tb_jadwal.jadwal_jam_mulai',
							'tb_jadwal.jadwal_jam_selesai',
							'tb_jadwal.jadwal_id',
							'tb_modul.modul_id')
					->where('tb_jadwal.jadwal_id', $jadwal_id)->get();

		foreach ($listModul as $modul) {
			$modul->hari = $listHari[$modul->jadwal_hari - 1];
		}

		return View::make('absensi.listmodul')->with('listModul', $listModul);
		
	}

	public function showDetailJadwal()
	{
		$jadwal_id = Input::get('jadwal');
		$modul_id = Input::get('modul');

		$asisten_nim = DB::table('view_user_asisten')
						->join('tb_lab', 'view_user_asisten.lab_id', '=', 'tb_lab.lab_id')
						->where('user_name', Session::get('user_name'))
						->pluck('asisten_nim');

		$valid = DB::table('tb_detail_praktikum_asisten')
					->join('tb_jadwal', 'tb_detail_praktikum_asisten.praktikum_id', '=', 'tb_jadwal.praktikum_id')
					->where('jadwal_id', $jadwal_id)
					->where('asisten_nim', $asisten_nim)->get();

		if(empty($valid))
		{
			return Redirect::to('asisten/jadwal')->with('error', 'Anda tidak memiliki hak untuk mengakses praktikum ini.');
		}

		$valid = DB::table('tb_modul')
					->join('tb_praktikum', 'tb_modul.praktikum_id', '=', 'tb_praktikum.praktikum_id')
					->join('tb_jadwal', 'tb_praktikum.praktikum_id', '=', 'tb_jadwal.praktikum_id')
					->where('tb_jadwal.jadwal_id', $jadwal_id)
					->where('tb_modul.modul_id', $modul_id)
					->get();

		if(empty($valid))
		{
			return Redirect::to('asisten/jadwal')->with('error', 'Data praktikum salah.');
		}

		$this->triggerAbsen($modul_id, $jadwal_id);

		$listMahasiswa = DB::table('tb_praktikan')
							->join('tb_absensi', 'tb_praktikan.praktikan_nim', '=', 'tb_absensi.praktikan_nim')
							->join('tb_modul', 'tb_absensi.modul_id', '=', 'tb_modul.modul_id')
							->join('tb_detail_jadwal_praktikan', 'tb_praktikan.praktikan_nim', '=','tb_detail_jadwal_praktikan.praktikan_nim')
							->join('tb_jadwal', 'tb_detail_jadwal_praktikan.jadwal_id', '=', 'tb_jadwal.jadwal_id')
							->where('tb_jadwal.jadwal_id', $jadwal_id)
							->where('tb_modul.modul_id', $modul_id)
							->get();

		return View::make('absensi.detailjadwal')->with('listMahasiswa', $listMahasiswa);
	}

	public function triggerAbsen($modul_id, $jadwal_id)
	{
		$listMahasiswa = DB::table('tb_praktikan')
							->join('tb_detail_jadwal_praktikan', 'tb_praktikan.praktikan_nim', '=', 'tb_detail_jadwal_praktikan.praktikan_nim')
							->join('tb_jadwal', 'tb_detail_jadwal_praktikan.jadwal_id', '=', 'tb_jadwal.jadwal_id')
							->where('tb_jadwal.jadwal_id', $jadwal_id)
							->get();

		foreach($listMahasiswa as $mahasiswa)
		{
			$checkAbsen = DB::table('tb_absensi')
							->where('praktikan_nim', $mahasiswa->praktikan_nim)
							->where('modul_id', $modul_id)->get();

			if(empty($checkAbsen))
			{
				$absensi = new Tb_Absensi();
				$absensi->praktikan_nim = $mahasiswa->praktikan_nim;
				$absensi->modul_id = $modul_id;
				$absensi->status = 0;

				$absensi->save();
			}
		}
	}

	public function editAbsen()
	{
		$input = Input::all();

		$absen = $this->absen($input['nimValue'], $input['modul'], $input['status'], $input['keterangan']);
		
		if($absen){
			return Redirect::to('asisten/detailJadwal?jadwal='.$input['jadwal'].'&modul='.$input['modul'])
					->with('success', 'Data Tersimpan');
		}

		return Redirect::to('asisten/detailJadwal?jadwal='.$input['jadwal'].'&modul='.$input['modul'])
					->with('error', 'Kesalahan');
	}

	public function absensi($praktikan_nim, $modul_id)
	{
		$status = DB::table('tb_absensi')
					->where('praktikan_nim', $praktikan_nim)
					->where('modul_id', $modul_id)
					->first();

		return $status;		
	}

	public function absen($praktikan_nim, $modul_id, $status, $keterangan)
	{
		$dataAbsen = $this->absensi($praktikan_nim, $modul_id);

		if($dataAbsen == null)
		{
			$absen = new Tb_Absensi();
			$absen->praktikan_nim = $praktikan_nim;
			$absen->modul_id = $modul_id;
			$absen->status = $status;

			$absen->save();

			return true;
		}else{
			DB::table('tb_absensi')
				->where('praktikan_nim', $praktikan_nim)
				->where('modul_id', $modul_id)
				->update(array('status' => $status, 'keterangan' => $keterangan));

			return true;
		}

		return false;
	}
}

?>