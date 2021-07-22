<?php

namespace saparicio;

use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
  protected $table='Empleado';
	protected $primaryKey='ci';
	public $timestamps=false;

	 protected $fillable=[
	 'ci',
	 'codigo',
	 'estado',
	 'idCargo',
    	'id'

    	 ];

    //atributo de tipo guarded

    protected $guarded = [

    ];
}
