<?php

namespace saparicio;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $table='Cliente';
	protected $primaryKey='ci';
	public $timestamps=false;

	protected $fillable=[
		'fechaUnion',
		'tipo',
		'estado'
	];
	protected $guarded=[];  }
