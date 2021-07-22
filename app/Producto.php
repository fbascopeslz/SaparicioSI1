<?php

namespace saparicio;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $table='Producto';

    protected $primaryKey='idProd';
    public $timestamps=false;

    protected $fillable=[
    	'descripcion',
    	'precio'	,
    	'estado',
    	'idSabor',	
    	'idMedida',	
    	'idPaquete',	
    	'idMarca',	
    	'idTipoEnvase',	
    	'idTipoBebida',
        'imagen',
    ];

    //atributo de tipo guarded

    protected $guarded = [

    ];
}
