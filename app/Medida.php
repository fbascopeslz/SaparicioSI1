<?php

namespace saparicio;

use Illuminate\Database\Eloquent\Model;

class Medida extends Model
{
    protected $table ='Medida';
    protected $primaryKey='idMedida';
    public $timestamps=false;

    protected $fillable=[
    'idMedida',
    'medida',
    'estado',

    ];
}
