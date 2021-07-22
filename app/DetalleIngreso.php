<?php

namespace saparicio;

use Illuminate\Database\Eloquent\Model;

class DetalleIngreso extends Model
{
    protected $table='detalleingreso';
	//protected $primaryKey='idDetalleIng';
	public $timestamps=false;

	protected $fillable=[
		'idIngreso',
		'idProd',
		'cantidad',
		'precioCompra',
		'precioVenta',
		'estado'
		//'inporte'
	];
	protected $guarded=[];    
}
