<?php

namespace saparicio;

use Illuminate\Database\Eloquent\Model;

class Inventario extends Model
{
     protected $table='inventario';

    protected $primaryKey='idProd';
    public $timestamps=false;

    protected $fillable=[
    	'idAlmacen',
    	'maxStock',
    	'minStock',
    	'stock'
    	
    ];

    //atributo de tipo guarded

    protected $guarded = [

    ];
}
