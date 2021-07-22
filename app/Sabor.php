<?php

namespace saparicio;

use Illuminate\Database\Eloquent\Model;

class Sabor extends Model
{
	protected    $table='Sabor';
	protected $primaryKey='idSabor';
	public $timestamps=false;

	protected $fillable=[
		'idSabor',
		'nombre',
		'estado',
	];
	 protected $guarded = [

    ];
}
