<?php

namespace saparicio;

use Illuminate\Database\Eloquent\Model;

class Zona extends Model
{
    protected $table='Zona';
	protected $primaryKey='idZona';
	public $timestamps=false;

	 protected $fillable=[
    	'nombre'
    	 ];

    //atributo de tipo guarded

    protected $guarded = [

    ];}
