<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Tdept extends Model {

		protected $table='tdepts';
	protected $fillable=['id','deptname','created_at'];
}
