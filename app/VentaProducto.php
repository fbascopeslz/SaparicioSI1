<?php

namespace saparicio;

use Illuminate\Database\Eloquent\Model;

class VentaProducto extends Model
{
   protected $table='VentaProducto';
	protected $primaryKey='idVenta';
	public $timestamps=false;

	protected $fillable=[
		
		'idprod',
		'cantidad',
		'precio'
		
		//'inporte'
	];
	protected $guarded=[];    
}
