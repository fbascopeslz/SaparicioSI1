<?php

namespace saparicio;

use Illuminate\Database\Eloquent\Model;

class Direccion extends Model
{
    protected $table='Direccion';
	protected $primaryKey='idDir';
	public $timestamps=false;

	protected $fillable=[
		'direccion',
		'obs',
		'ci',
		'idZona'

	];
	protected $guarded=[];  
}
