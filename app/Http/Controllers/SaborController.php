<?php

namespace saparicio\Http\Controllers;

use Illuminate\Http\Request;

use saparicio\Http\Requests;
use saparicio\Sabor;//hace referencia al modelo app/TipoBebida
use Illuminate\Support\Facades\Redirect;
use saparicio\Http\Requests\SaborFormRequest;

use DB;
class SaborController extends Controller
{
    public function __construct()
    {
       $this->middleware('auth');
       $this->middleware('permission:inventario.sabor.create')->only(['create','store']);
        $this->middleware('permission:inventario.sabor.index')->only(['index']);
    $this->middleware('permission:inventario.sabor.edit')->only(['edit','update']);
       $this ->middleware('permission:inventario.sabor.show')->only(['show']);
        $this->middleware('permission:inventario.sabor.destroy')->only(['destroy']);

    }
    public function index(Request $request)
    {
    	if ($request)
    	{//obtenga todo el registro 
    		$query=trim($request->get('searchText'));
    		$sabores=DB::table('Sabor')->where('nombre','LIKE','%'.$query.'%')
    		->where('estado','=','1')
    		->orderBy('idSabor','desc')
    		->paginate(7);

    		return view('inventario.sabor.index',["sabores"=>$sabores,"searchText"=>$query]);
    	}
    }
    public function create()
    {
    	return view("inventario.sabor.create");
    	
    }
    /*crea un objeto TipoBebida*/
    public function store(SaborFormRequest $request)
    {
    	$sabores=new Sabor;
    	$sabores->nombre=$request->get('nombre');//esta en tipobebida forma request
    	$sabores->estado='1';
    	$sabores->save();//guarda en la base de datos

    	return Redirect::to('inventario/sabor')->with('info','sabor guardado con exito');
    }

    public function show($id)//VERIFICAR LO ULTIMO
    {
    	return view("inventario.sabor.show",["sabores"=>Sabor::findOrFail($id)]);//Modelo TipoBebida
    }

    public function edit($id)
    {
    	
    	return view("inventario.sabor.edit",["sabores"=>Sabor::findOrFail($id)]);
    }
    public function update(SaborFormRequest $request,$id)
    {
    	$sabores=Sabor::findOrFail($id);
    	$sabores->nombre=$request->get('nombre');
    	$sabores->update();
    	return Redirect::to('inventario/sabor');
    }
    public function destroy($id)
    {
    	$sabores=Sabor::findOrFail($id);
    	$sabores->estado='0';
    	$sabores->update();
    	return Redirect::to('inventario/sabor');
    }}
