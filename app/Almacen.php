<?php

namespace saparicio;

use Illuminate\Database\Eloquent\Model;

class Almacen extends Model
{
    protected $table='almacen';
	protected $primaryKey='idAlmacen';
	public $timestamps=false;

	 protected $fillable=[
	 'descripcion',
    	'ubicacion'

    	 ];
}
