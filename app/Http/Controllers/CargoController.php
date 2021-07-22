<?php

namespace saparicio\Http\Controllers;

use Illuminate\Http\Request;
use saparicio\Http\Requests;
use saparicio\Cargo;
use Illuminate\Support\Facades\Redirect;
use saparicio\Http\Requests\CargoFormRequest;
use Illuminate\Support\Facades\Auth; // para acceder a datos del personal autenticado / o id
use DB;


class CargoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
       $this->middleware('permission:personal.cargo.create')->only(['create','store']);
        $this->middleware('permission:personal.cargo.index')->only(['index']);
    $this->middleware('permission:personal.cargo.edit')->only(['edit','update']);
       $this ->middleware('permission:personal.cargo.show')->only(['show']);
        $this->middleware('permission:personal.cargo.destroy')->only(['destroy']);
    }

    public function index(Request $request)
    {
    	if ($request)
    	{//obtenga todo el registro 
                            //$user_id = Auth::user()->id;
                            //$id = Auth::id();
    		$query=trim($request->get('searchText'));
    		$cargos=DB::table('Cargo')->where('cargo','LIKE','%'.$query.'%')
    		->where('estado','=','1')
                             
    		->orderBy('idCargo','desc')
    		->paginate(7);

    		return view('personal.cargo.index',["cargos"=>$cargos,"searchText"=>$query]);
    	}
    }
    public function create()
    {
    	return view("personal.cargo.create");
    	
    }
    /*crea un objeto TipoBebida*/
    public function store(CargoFormRequest $request)
    {
    	$cargos=new Cargo;
    	$cargos->cargo=$request->get('cargo');//esta en tipobebida forma request
            $cargos->estado='1';
    	$cargos->save();//guarda en la base de datos

            //return view('personal/cargo');
    	return Redirect::to('personal/cargo');
    }

    public function show($id)//VERIFICAR LO ULTIMO
    {
    	return view("personal.cargo.show",["cargos"=>Cargo::findOrFail($id)]);//Modelo TipoBebida
    }

    public function edit($id)
    {
    	
    	return view("personal.cargo.edit",["cargos"=>Cargo::findOrFail($id)]);
    }
    public function update(CargoFormRequest $request,$id)
    {
    	$cargos=Cargo::findOrFail($id);
    	$cargos->cargo=$request->get('cargo');
    	$cargos->update();
    	return Redirect::to('personal/cargo');
    }
    public function destroy($id)
    {
    	$cargos=Cargo::findOrFail($id);
            $cargos->estado='0';
    	$cargos->update();
    	return Redirect::to('personal/cargo');
    }
}
