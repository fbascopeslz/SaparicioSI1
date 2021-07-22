<?php

namespace saparicio;

use Illuminate\Database\Eloquent\Model;

class TipoBebida extends Model
{
    protected $table='TipoBebida';

    protected $primaryKey='idTipoBebida';
    public $timestamps=false;

    protected $fillable=[
    	'idTipoBebida',
    	'tipo',
            'estado',
    ];

    //atributo de tipo guarded

    protected $guarded = [

    ];
}
