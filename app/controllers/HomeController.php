<?php

class HomeController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

	public function showWelcome()
	{
		return View::make('login');
	}

	/*Login User*/
	public function authenticate()
	{
		$userdata = array(
				'user_name' => Input::get('username'),
				'password' => Input::get('password')
			);
			if(Auth::attempt($userdata)){
				$username_result =Input::get('username');

				$role_result = DB::table('tb_user')->where('user_name', $username_result)->pluck('role_id');
				Session::put('user_name',$username_result);
				Session::put('role_id',$role_result);
				Session::put('role_id',$role_result);

				return Redirect::to('/');
			}else{
				return Redirect::to('/')
			        ->with('pesan_error', 'Kombinasi username atau password Anda salah. Silakan ulangi lagi ! ')
			        ->withInput();
			}
	}

	public function doLogout() {
		Session::flush();
   		return Redirect::to('/');
	}

	public function Confirmation(){
		return View::make ('confirmation');
	}

	/*Registering Users*/
	public function RegisterAdmin()
	{
		$rules = array(
			'username' => 'required',
			'password' => 'required'
		);
		$validator = Validator::make(Input::all(), $rules);

		if ($validator->fails()) {
			return Redirect::to('registers.register_admin')
				->withErrors($validator)
				->withInput(Input::except('password'));
		} else {
			
			$user = new Tb_User;
			$user->user_name = Input::get('username');
			$user->password  = Hash::make(Input::get('password'));
			$user->role_id  = '0';
			$user->save();
			
			return Redirect::to('/');
		}
	}

	public function register(){
		$list_kelas= new Tb_Kelas;
		$list_kelas=array('' => 'Pilih Kelas Asal') +Tb_Kelas::lists('kelas_nama', 'kelas_id');
		return View::make ('register')->with('list_kelas',$list_kelas);

	}
	public function RegisterPraktikan(){
		$input=Input::all();
		$rules=array(
			'praktikan_nim'=>'required|min:10|numeric',
			'praktikan_nama'=>'required',
			'kelas_nama'=>'required',
			'praktikan_telp'=>'required|numeric',
			'praktikan_email'=>'required|email',
			'username'=>'required|min:1',
			'password'=>'required|min:1|alpha_num'
			);
		$validation = Validator::make($input,$rules);
		if($validation->fails())
		{
			return Redirect::to('register')->withErrors($validation)->withInput();;
		}
		else if(Input::get('password') == Input::get('confirm_password')){
			if(Input::hasFile('file')){
				$files = array('files' => Input::file('file'));
				$rules = array('files'=>'max:1000');

				$ext = Input::file('file')->getClientOriginalExtension();

				$validation = Validator::make($files, $rules);

				if($validation->fails())
				{
					return Redirect::to('register')->withErrors($validation)
						->withInput();
				}

				$listExt = array('jpg', 'png', 'jpeg', 'gif', 'bmp');

				if(!in_array(strtolower($ext), $listExt)){
					return Redirect::to('register')->with('pesan_error', 'Format file salah')
						->withInput();;
				}

				$pubpath = public_path();
				$directory = $pubpath.'/uploads/user_profpic';
				$filename = Input::get('praktikan_nim').".jpeg";
				Input::file('file')->move($directory, $filename);
			}

			$user = new Tb_User;
			$praktikan =  new Tb_Praktikan;
			$tb_detail_praktikan_kelas =new Tb_Detail_Praktikan_Kelas;
					
			$user->user_name = Input::get('username');
			$user->password  = Hash::make(Input::get('password'));
			$user->role_id  = '4';
					

			$praktikan->praktikan_nim  =Input::get('praktikan_nim');
			$praktikan->praktikan_nama =Input::get('praktikan_nama');
			$praktikan->praktikan_email =Input::get('praktikan_email');
			$praktikan->praktikan_telp =Input::get('praktikan_telp');
			$praktikan->praktikan_foto = Input::get('praktikan_nim');

			$tb_detail_praktikan_kelas->praktikan_nim  = Input::get('praktikan_nim');
			$tb_detail_praktikan_kelas->kelas_id  =Input::get('kelas_nama');

			$checkNim=DB::table('tb_praktikan')
						->where('praktikan_nim','=',Input::get('praktikan_nim'))
						->pluck('praktikan_nim');
			$checkUser=DB::table('tb_user')
						->where('user_name',Input::get('username'))
						->pluck('user_name');

			
			if($checkNim == null && $checkUser == null){
				$user->save();

				$user = DB::table('tb_user')->where('user_name',Input::get('username'))->pluck('user_id');
		
				$praktikan->user_id=$user;
				$praktikan->save();
								
				$tb_detail_praktikan_kelas->save();
					
				return Redirect::to('login')->with('success', 'Selamat, Anda telah terdaftar');
			}else{
				return Redirect::to('register')->with('pesan_error', 'Username atau NIM sudah terdaftar ! ')
			        ->withInput();
			}
			
		}else{
			return Redirect::to('register')->with('pesan_error', 'Password tidak sama! ')
			        ->withInput();
		}
	}

	

}

