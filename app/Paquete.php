<?php

namespace saparicio;

use Illuminate\Database\Eloquent\Model;

class Paquete extends Model
{
    protected $table='Paquete';

    protected $primaryKey='idPaquete';
    public $timestamps=false;

    protected $fillable=[
    	'idPaquete',
    	'cantidad',
    	'descripcion',
            'estado',
    ];
}
