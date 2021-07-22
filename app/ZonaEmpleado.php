<?php

namespace saparicio;

use Illuminate\Database\Eloquent\Model;

class ZonaEmpleado extends Model
{
    protected $table='ZonaEmpleado';
	protected $primaryKey='ci';
	public $timestamps=false;

	 protected $fillable=[
    	'dias',
    	'idZona',
    	'ci'
    	 ];

    //atributo de tipo guarded

    protected $guarded = [

    ];}
