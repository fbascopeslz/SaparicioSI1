<?php

namespace saparicio\Http\Controllers;

use Illuminate\Http\Request;

use saparicio\Http\Requests;
use saparicio\TipoBebida;//hace referencia al modelo app/TipoBebida
use Illuminate\Support\Facades\Redirect;
use saparicio\Http\Requests\TipoBebidaFormRequest;


use DB;

class TipoBebidaController extends Controller
{
     public function __construct()
    {
       $this->middleware('auth');
       $this->middleware('permission:inventario.tipobebida.create')->only(['create','store']);
        $this->middleware('permission:inventario.tipobebida.index')->only(['index']);
    $this->middleware('permission:inventario.tipobebida.edit')->only(['edit','update']);
       $this ->middleware('permission:inventario.tipobebida.show')->only(['show']);
        $this->middleware('permission:inventario.tipobebida.destroy')->only(['destroy']);
    }
    public function index(Request $request)
    {
    	if ($request)
    	{//obtenga todo el registro 
    		$query=trim($request->get('searchText'));
    		$TipoBebidas=DB::table('TipoBebida')->where('tipo','LIKE','%'.$query.'%')
    		->where('estado','=','1')
    		->orderBy('idTipoBebida','desc')
    		->paginate(7);

    		return view('inventario.tipobebida.index',["tipobebidas"=>$TipoBebidas,"searchText"=>$query]);
    	}
    }
    public function create()
    {
    	return view("inventario.tipobebida.create");
    	
    }
    /*crea un objeto TipoBebida*/
    public function store(TipoBebidaFormRequest $request)
    {
    	$tipobebida=new TipoBebida;
    	$tipobebida->tipo=$request->get('tipo');//esta en tipobebida forma request
    	$tipobebida->estado='1';
    	$tipobebida->save();//guarda en la base de datos

    	return Redirect::to('inventario/tipobebida');
    }

    public function show($id)//VERIFICAR LO ULTIMO
    {
    	return view("inventario.tipobebida.show",["tipobebidas"=>TipoBebida::findOrFail($id)]);//Modelo TipoBebida
    }

    public function edit($id)
    {
    	
    	return view("inventario.tipobebida.edit",["tipobebidas"=>TipoBebida::findOrFail($id)]);
    }
    public function update(TipoBebidaFormRequest $request,$id)
    {
    	$tipobebida=TipoBebida::findOrFail($id);
    	$tipobebida->tipo=$request->get('tipo');
    	$tipobebida->update();
    	return Redirect::to('inventario/tipobebida');
    }
    public function destroy($id)
    {
    	$tipobebida=TipoBebida::findOrFail($id);
    	$tipobebida->estado='0';
    	$tipobebida->update();
    	return Redirect::to('inventario/tipobebida');
    }
}

