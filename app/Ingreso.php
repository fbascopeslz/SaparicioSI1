<?php

namespace saparicio;

use Illuminate\Database\Eloquent\Model;

class Ingreso extends Model
{
	protected $table='Ingreso';
	protected $primaryKey='idIngreso';
	public $timestamps=false;

	protected $fillable=[
		'idProveedor',
		'tipoComprobante',
		'serieComprobante',
		'numComprobante',
		'fecha',
		'impuesto',
		'estado'
	];
	protected $guarded=[];    
}
