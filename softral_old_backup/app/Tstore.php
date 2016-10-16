<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Tstore extends Model {


	protected $table='tstores';
	protected $fillable=['tno','tuserid','tusername','tuseremail','tdept','tpri','tmsg','tstatus','tview','created_at'];
	
	public function user()
    {
        return $this->hasOne('LaravelAcl\Authentication\Models\User', 'id','tuserid');
    }
}
