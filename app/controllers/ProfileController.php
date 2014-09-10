<?php
class ProfileController extends HomeController
{

	public function __construct()
	{
		$this->beforeFilter(function()
		{
			if(Session::get('user_name')==null){
				return Redirect::to('login');
			}
		});
	}

	public function showAsisten()
	{
		$profile = new Profile;
		$data = $profile->profileAsisten();

		return View::make('profile.asisten')->with('data', $data);
	}

	public function showDosen()
	{
		$profile = new Profile;
		$data = $profile->profileDosen();

		return View::make('profile.dosen')->with('data', $data);
	}

	public function showPraktikan()
	{
		$profile = new Profile;
		$data = $profile->profilePraktikan();

		return View::make('profile.praktikan')->with('data', $data);
	}

	public function viewPraktikan()
	{

	}

	public function showLab()
	{
		$data = DB::table('tb_lab')->get();

		return View::make('profile.listlab')->with('datas', $data);
	}

	public function selectProfile()
	{
		$profile = new Profile;

		switch (Session::get('role_id')) {
			case 1:
				return $this->showAsisten();

			case 2:
				return $this->showAsisten();

			case 3:
				return $this->showAsisten();

			case 4:
				return $this->showPraktikan();

			case 5:
				return $this->showDosen();

			default:
				return Redirect::to('/');
				break;
		}

	}

	public function editPassword()
	{
		$input = Input::all();
		$pass = Tb_User::where('user_name', Session::get('user_name'))->first();

		if($input['ulangPass'] != $input['passBaru'])
			return Redirect::to('profile')->with('error', 'Password Baru Tidak Sama');

		if(Hash::check($input['passLama'], $pass->password)){
			DB::table('tb_user')
			->where('user_name', Session::get('user_name'))
			->update(array('password' => Hash::make($input['passBaru'])));
			return Redirect::to('profile')->with('success', 'Password Berhasil Diganti');
		}else{
			return Redirect::to('profile')->with('error', 'Password Lama Salah');
		}
	}

	public function editProfile()
	{
		$input = Input::all();

		$rules=array(
			'phoneNumber'=>'required|numeric',
			'email'=>'required|email'
			);
		$validation = Validator::make($input,$rules);
		if($validation->fails())
		{
			return Redirect::to('profile')->withErrors($validation);
		}

		$database = DB::table('tb_user')
							->join('tb_praktikan', 'tb_user.user_id', '=', 'tb_praktikan.user_id')
							->where('tb_user.user_name', Session::get('user_name'))->first();

		if($input['profilePic'] != null){
			$pubpath = public_path();
			$directory = $pubpath.'uploads/user_profpic';
			$filename = $database->praktikan_nim;
			$upload_success = $input['profilePic']->move($directory,$filename.".jpeg");
		}
		
		$data = DB::table('tb_praktikan')
					->where('praktikan_nim', $database->praktikan_nim)
					->update(array('praktikan_email' => $input['email'], 'praktikan_telp' => $input['phoneNumber']));
		return Redirect::to('profile')->with('success', 'Data Tersimpan');
	}
}
?>