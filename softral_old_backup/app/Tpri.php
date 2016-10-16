<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Tpri extends Model {

	protected $table='tpris';
	protected $fillable=['id','priname','created_at'];
}
