
<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class AsistenPraktikum extends Eloquent implements UserInterface, RemindableInterface {

	/*public static function getAsistensThat ($praktikum_id){
		$mRows =	DB::table('tb_detail_praktikum_asisten')
						->join('tb_asisten', 'tb_asisten.asisten_nim', '=', 'tb_detail_praktikum_asisten.asisten_nim')
						->where('praktikum_id', '=', $praktikum_id)
						->get(array(
							'asisten_nama',
							'tb_asisten.asisten_nim',
							'tb_detail_praktikum_asisten.no'
							));
		$mAsistens = array();
	    foreach( $mRows as $mRow )
	    {
	      $asisten = new AsistenPraktikum( array(), true );
	      $asisten->fill_raw( (array) $mRow);
	      $mAsistens[] = $asisten;
	    }
	    return $mRows;
	}*/

	use UserTrait, RemindableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	public $primaryKey='no';
	protected $table = 'tb_detail_praktikum_asisten';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password', 'remember_token');

}
