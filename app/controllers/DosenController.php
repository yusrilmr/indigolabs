<?php

class DosenController extends BaseController {
	public function __construct()
    {
        $this->beforeFilter(function()
        {
            if(Session::get('role_id')!='5'){
				return View::make('login');
			}else{
				
			}
        });
    }
	public function showWelcome()
	{
		return View::make('dashboard.dosen.dosen_index');
	}

	public function absensiLab()
	{
		$data = DB::table('tb_lab')->get();

		return View::make('absensi.listlab')->with('datas', $data);
	}

	public function listpraktikumlab($error = null){
		$listLab = DB::table('tb_lab')
					->select('tb_lab.lab_id', 'tb_lab.lab_nama', 'tb_lab.lab_keterangan')
					->get();
		
		return View::make('dashboard.dosen.dosen_listpraktikumlab')->with('listLab', $listLab);
	}
	
	public function pilihpraktikumlab(){
		$id = Input::get('id');
		$lab = DB::table('tb_lab')->where('lab_id', $id)->get();

		if(empty($lab)){
			return Redirect::to('/DataAbsen/DaftarLab')
				->with('error', 'Lab tidak di temukan');
		}

		$listPraktikum = DB::table('tb_lab')
							->join('tb_praktikum', 'tb_lab.lab_id', '=', 'tb_praktikum.lab_id')
							->select('tb_lab.lab_nama', 'tb_praktikum.praktikum_nama', 'tb_praktikum.praktikum_id')
							->where('tb_lab.lab_id', $id)->get();

		return View::make('dashboard.dosen.dosen_pilih_praktikum_absen')->with('listPraktikum', $listPraktikum);
	}

	public function dataabsen()
	{
		$praktikum_id = Input::get('praktikum');
		$kelas_id = Input::get('kelas');

		if(empty($praktikum_id) || empty($kelas_id)){
			return Redirect::to('/DataAbsen/DaftarLab')
				->with('error', 'Praktikum / Kelas tidak ditemukan');
		}

		$labInfo = DB::table('tb_praktikum')
					->join('tb_lab', 'tb_praktikum.lab_id', '=', 'tb_lab.lab_id')
					->select('tb_praktikum.praktikum_id', 'tb_praktikum.praktikum_nama', 'tb_lab.lab_id', 'tb_lab.lab_nama')
					->where('tb_praktikum.praktikum_id', $praktikum_id)
					->first();

		$kelasInfo = DB::table('tb_kelas')
						->where('kelas_id', $kelas_id)
						->first();

		$dataMahasiswa = DB::table('tb_praktikan')
							->join('tb_detail_praktikan_kelas', 'tb_praktikan.praktikan_nim', '=', 'tb_detail_praktikan_kelas.praktikan_nim')
							->join('tb_detail_jadwal_praktikan', 'tb_praktikan.praktikan_nim', '=', 'tb_detail_jadwal_praktikan.praktikan_nim')
							->join('tb_jadwal', 'tb_detail_jadwal_praktikan.jadwal_id', '=', 'tb_jadwal.jadwal_id')
							->select('tb_praktikan.praktikan_nim','tb_praktikan.praktikan_nama')
							->where('tb_jadwal.praktikum_id', $praktikum_id)
							->where('tb_detail_praktikan_kelas.kelas_id', $kelas_id)
							->get();

		if(empty($dataMahasiswa)){
			return Redirect::to('/DataAbsen/DaftarLab')
				->with('error', 'Data tidak ditemukan');
		}

		$totalModul = DB::table('tb_modul')
						->where('praktikum_id', $praktikum_id)
						->orderBy('modul_nama')->get();

		$noModul = 1;
		foreach ($totalModul as $modul) {
			$modul->no = $noModul;
			$noModul++;
		}

		$noMahasiswa = 1;
		foreach ($dataMahasiswa as $mahasiswa) {
			$mahasiswa->no = $noMahasiswa;
			$absen = null;

			$kehadiran = 0;
			$total = 0;
			foreach ($totalModul as $modul) {
				$absensi = DB::table('tb_absensi')
							->where('praktikan_nim', $mahasiswa->praktikan_nim)
							->where('modul_id', $modul->modul_id)
							->first();

				if($absensi!=null && $absensi->status == 1){
					$kehadiran++;
				}
				$total++;

				$dataModul = new stdClass();
				$dataModul->info = $modul;
				$dataModul->absensi = $absensi;

				$absen[] = $dataModul;
			}

			if($total == 0){
				return Redirect::to('/DataAbsen/DaftarLab')
				->with('error', 'Modul tidak terdaftar');
			}
			$mahasiswa->kehadiran = $kehadiran/$total * 100;
			$mahasiswa->absen = $absen;

			$noMahasiswa++;
		}

		return View::make ('dashboard.dosen.dosen_dataabsen1')
				->with(array('labInfo' => $labInfo,
							'kelasInfo' => $kelasInfo, 
							'totalModul' => $totalModul, 
							'dataMahasiswa' => $dataMahasiswa));
	}

	public function listkelas(){
		$praktikum_id = Input::get('id');

		$labInfo = DB::table('tb_praktikum')
					->join('tb_lab', 'tb_praktikum.lab_id', '=', 'tb_lab.lab_id')
					->select('tb_lab.lab_nama', 'tb_praktikum.praktikum_nama', 'tb_praktikum.praktikum_id')
					->where('tb_praktikum.praktikum_id', $praktikum_id)
					->first();

		$listKelas = DB::table('view_praktikum_kelas')
					->where('praktikum_id', $praktikum_id)
					->select('kelas_nama', 'kelas_id')
					->orderBy('kelas_nama')
					->get();

		$no = 1;
		foreach ($listKelas as $kelas) {
			$quota = DB::table('tb_detail_praktikan_kelas')
						->join('tb_praktikan', 'tb_detail_praktikan_kelas.praktikan_nim', '=', 'tb_praktikan.praktikan_nim')
						->join('tb_detail_jadwal_praktikan', 'tb_praktikan.praktikan_nim', '=', 'tb_detail_jadwal_praktikan.praktikan_nim')
						->select(DB::raw('COUNT(*) as quota'))
						->where('kelas_id', $kelas->kelas_id)
						->pluck('quota');

			$kelas->no = $no;
			$kelas->quota = $quota;
			$no++;
		}

		$labInfo->listKelas = $listKelas;

		return View::make('dashboard.dosen.dosen_datakelas')->with('labInfo', $labInfo);
	}

	public function printabsen()
	{
		return View::make('dashboard.dosen.dosen_print_absen');
	}

}

?>