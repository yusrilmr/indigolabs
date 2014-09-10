
<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class Asisten extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	public $primaryKey='asisten_nim';
	protected $table = 'tb_asisten';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password', 'remember_token');

	/*public static function insert_tb_detail_lab_asisten($lab_id, $asisten_nim) {
		DB::table('tb_detail_lab_asisten')->insert(
		    array('lab_id' => $lab_id, 'asisten_nim' => $asisten_nim)
		);
	}*/

	public static function insert_tb_user($nim) {
		$user = new Tb_User;

		$user->user_name	= $nim;;
		$user->password 	= Hash::make($nim);
		$user->role_id 		= 3;

		$user->save();
	}

}
