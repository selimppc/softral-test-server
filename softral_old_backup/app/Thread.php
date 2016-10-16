<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Thread extends Model {


	protected $table='threads';
	protected $fillable=['tid','tuserid','tusername','tuseremail','tmsg','tstatus','created_at'];

	public function user()
    {
        return $this->hasOne('LaravelAcl\Authentication\Models\User', 'id','tuserid');
    }	

}
