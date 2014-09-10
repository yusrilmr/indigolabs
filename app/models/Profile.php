<?php
	class Profile {

		public function profileAsisten(){
			$data = DB::table('tb_user')
				-> join('tb_asisten', 'tb_user.user_id', '=', 'tb_asisten.user_id')
				-> where('tb_user.user_name', Session::get('user_name')) -> first();

			return $data;
		}

		public function profilePraktikan(){
			$data = DB::table('tb_user')
				-> join('tb_praktikan', 'tb_user.user_id', '=', 'tb_praktikan.user_id')
				-> where('tb_user.user_name', Session::get('user_name'))->first();

			return $data;
		}

		public function profileDosen(){
			$data = DB::table('tb_user')
				-> join('tb_dosen', 'tb_user.user_id', '=', 'tb_dosen.user_id')
				-> where('tb_user.user_name', Session::get('user_name'))->first();

			return $data;	
		}

	}
?>