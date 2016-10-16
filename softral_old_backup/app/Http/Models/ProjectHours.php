<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

/**
 * CountryList
 *
 */
class ProjectHours extends Model {

	/**
	 * @var string
	 * Path to the directory containing countries data.
	 */
	protected $table = 'project_hours'; 
	protected $dates = ['created_at', 'updated_at'];
	protected $guarded = array('id');
	
	protected $fillable = [
		'job_id',
		'proposal_id',
		'contract_id',
		'date',
		'hours',
		'task'
    ];

    public function getModifiedDateAttribute($value)
    {
	  $created = new Carbon();
      return $created::createFromFormat('Y-m-d H:i:s', $this->date)->format('M d, Y');
    }



	}
	
