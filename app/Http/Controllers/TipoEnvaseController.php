<?php

namespace saparicio\Http\Controllers;

use Illuminate\Http\Request;
use saparicio\Http\Requests;
use saparicio\TipoEnvase;//hace referencia al modelo app/TipoBebida
use Illuminate\Support\Facades\Redirect;
use saparicio\Http\Requests\TipoEnvaseFormRequest;


use DB;
class TipoEnvaseController extends Controller
{
      public function __construct()
    {
       $this->middleware('auth');
       $this->middleware('permission:inventario.tipoenvase.create')->only(['create','store']);
        $this->middleware('permission:inventario.tipoenvase.index')->only(['index']);
    $this->middleware('permission:inventario.tipoenvase.edit')->only(['edit','update']);
       $this ->middleware('permission:inventario.tipoenvase.show')->only(['show']);
        $this->middleware('permission:inventario.tipoenvase.destroy')->only(['destroy']);
    }
    public function index(Request $request)
    {
    	if ($request)
    	{//obtenga todo el registro 
    		$query=trim($request->get('searchText'));
    		$TipoEnvases=DB::table('TipoEnvase')->where('tipo','LIKE','%'.$query.'%')
    		->where('estado','=','1')
    		->orderBy('idTipoEnvase','desc')
    		->paginate(7);

    		return view('inventario.tipoenvase.index',["tipoenvases"=>$TipoEnvases,"searchText"=>$query]);
    	}
    }
    public function create()
    {
    	return view("inventario.tipoenvase.create");
    	
    }
    /*crea un objeto TipoBebida*/
    public function store(TipoEnvaseFormRequest $request)
    {
    	$tipoenvase=new TipoEnvase;
    	$tipoenvase->tipo=$request->get('tipo');//esta en tipobebida forma request
    	$tipoenvase->estado='1';
    	$tipoenvase->save();//guarda en la base de datos

    	return Redirect::to('inventario/tipoenvase');
    }

    public function show($id)//VERIFICAR LO ULTIMO
    {
    	return view("inventario.tipoenvase.show",["tipoenvases"=>TipoEnvase::findOrFail($id)]);//Modelo TipoBebida
    }

    public function edit($id)
    {
    	
    	return view("inventario.tipoenvase.edit",["tipoenvases"=>TipoEnvase::findOrFail($id)]);
    }
    public function update(TipoEnvaseFormRequest $request,$id)
    {
    	$tipoenvase=TipoEnvase::findOrFail($id);
    	$tipoenvase->tipo=$request->get('tipo');
    	$tipoenvase->update();
    	return Redirect::to('inventario/tipoenvase');
    }
    public function destroy($id)
    {
    	$tipoenvase=TipoEnvase::findOrFail($id);
    	$tipoenvase->estado='0';
    	$tipoenvase->update();
    	return Redirect::to('inventario/tipoenvase');
    }}
