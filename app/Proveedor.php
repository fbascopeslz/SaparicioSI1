<?php

namespace saparicio;

use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    protected $table='Proveedor';
    protected $primaryKey='idProveedor';
    public $timestamps=false;

    protected $fillable=[
	    'idProveedor',
	    'nombre',
	    'debe',
	    'haber',
	    'limiteCredito',
	    'estado'
	    ];

protected $guarded=[];

}
