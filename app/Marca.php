<?php

namespace saparicio;

use Illuminate\Database\Eloquent\Model;

class Marca extends Model
{
      protected $table='Marca';

    protected $primaryKey='idMarca';
    public $timestamps=false;

    protected $fillable=[
    	'idMarca',
    	'nombre',
           'estado',  ];

    //atributo de tipo guarded

    protected $guarded = [

    ];
}
