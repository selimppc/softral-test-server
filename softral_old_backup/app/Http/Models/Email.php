<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

/**
 * CountryList
 *
 */
class Email extends Model {

	/**
	 * @var string
	 * Path to the directory containing countries data.
	 */
	protected $table = 'send_mails'; 
	protected $dates = ['created_at', 'updated_at'];
	
	protected $fillable = [
		'email',
		'message',
    ];
	
	public function getModifiedUpdatedAtAttribute($value)
    {
        $created = new Carbon();
		return $created::createFromFormat('Y-m-d H:i:s', $this->updated_at)->format('M d, Y');
    }
	
}