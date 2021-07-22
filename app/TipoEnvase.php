<?php

namespace saparicio;

use Illuminate\Database\Eloquent\Model;

class TipoEnvase extends Model
{
    protected $table='TipoEnvase';
    protected $primaryKey='idTipoEnvase';
    public $timestamps=false;

    protected $fillable=[
    'idTipoEnvase',
    'tipo',
    'estado',

    ];

    protected $guarded
    =[];
}
