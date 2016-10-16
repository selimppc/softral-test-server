<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * CountryList
 *
 */
class Notifications extends Model {

	/**
	 * @var string
	 * Path to the directory containing countries data.
	 */
	protected $table = 'notification';
	protected $dates = ['created_at', 'updated_at'];	
	
	protected $fillable = [
        'user_id'	,
		'label',
		'proposal_id',
		'job_id',
		'amount',
		'status',
    ];
	
	public function user()
    {
        return $this->hasOne('LaravelAcl\Authentication\Models\User', 'id','user_id');
    }
	
	public function job()
    {
        return $this->hasOne('App\Http\Models\Job', 'id','job_id');
    }
	
	public function proposal()
    {
        return $this->hasOne('App\Http\Models\Proposal', 'id','proposal_id');
    }
	
	
	
	
	
	
}