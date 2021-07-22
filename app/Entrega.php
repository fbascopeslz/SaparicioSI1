<?php

namespace saparicio;

use Illuminate\Database\Eloquent\Model;

class Entrega extends Model
{
      protected $table='venta';

    protected $primaryKey='idVenta';
    public $timestamps=false;

    protected $fillable=[
    	
    	'cantidad',
    	'total',
            'estado',
            'ciCliente',
            'ciPromotor',
            'ciChofer'
    ];
}
