<?php

namespace saparicio;

use Illuminate\Database\Eloquent\Model;


class Cargo extends Model
{
	protected $table='Cargo';
	protected $primaryKey='idCargo';
	public $timestamps=false;

	 protected $fillable=[
	 'idCargo',
    	'cargo'

    	 ];

    //atributo de tipo guarded

    protected $guarded = [

    ];
}
