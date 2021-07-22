<?php

namespace saparicio;

use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
       protected $table='Persona';

    protected $primaryKey='ci';
    public $timestamps=false;

    protected $fillable=[
            
    	'nombre',
    	'paterno',
    	'materno',
    	'sexo',
    	'fechaNac',
            'telefono'

    ];

    //atributo de tipo guarded

    protected $guarded = [

    ];
}
