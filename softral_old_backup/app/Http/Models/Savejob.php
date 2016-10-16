<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * CountryList
 *
 */
class Savejob extends Model {

	/**
	 * @var string
	 * Path to the directory containing countries data.
	 */
	protected $table = 'save_jobs'; 
	public $timestamps = false;
	
	protected $fillable = [
        'job_id',
		'user_id',
		'save_user_id'
    ];
	
	public function job()
    {
        return $this->belongsTo('App\Http\Models\Job', 'job_id');
    }
	
	public function user()
    {
        return $this->hasOne('LaravelAcl\Authentication\Models\User', 'id','save_user_id');
    }

}
