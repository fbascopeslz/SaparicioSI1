<?php

namespace saparicio\Http\Controllers;

use Illuminate\Http\Request;
use saparicio\Http\Requests;
use saparicio\Paquete;//hace referencia al modelo app/TipoBebida
use Illuminate\Support\Facades\Redirect;
use saparicio\Http\Requests\PaqueteFormRequest;


use DB;

class PaqueteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
       $this->middleware('permission:inventario.paquete.create')->only(['create','store']);
        $this->middleware('permission:inventario.paquete.index')->only(['index']);
    $this->middleware('permission:inventario.paquete.edit')->only(['edit','update']);
       $this ->middleware('permission:inventario.paquete.show')->only(['show']);
        $this->middleware('permission:inventario.paquete.destroy')->only(['destroy']);
    }
    public function index(Request $request)
    {
    	if ($request)
    	{//obtenga todo el registro 
    		$query=trim($request->get('searchText'));
    		$paquetes=DB::table('Paquete')->where('descripcion','LIKE','%'.$query.'%')
    		->where('estado','=','1')
    		->orderBy('idPaquete','desc')
    		->paginate(7);

    		return view('inventario.paquete.index',["paquetes"=>$paquetes,"searchText"=>$query]);
    	}
    }
    public function create()
    {
    	return view("inventario.paquete.create");
    	
    }
    /*crea un objeto TipoBebida*/
    public function store(PaqueteFormRequest $request)
    {
    	$paquete=new Paquete;
    	$paquete->descripcion=$request->get('descripcion');//esta en tipobebida forma request
    	$paquete->cantidad=$request->get('cantidad');
    	$paquete->estado='1';
    	$paquete->save();//guarda en la base de datos

    	return Redirect::to('inventario/paquete');
    }

    public function show($id)//VERIFICAR LO ULTIMO
    {
    	return view("inventario.paquete.show",["paquetes"=>Paquete::findOrFail($id)]);//Modelo TipoBebida
    }

    public function edit($id)
    {
    	
    	return view("inventario.paquete.edit",["paquetes"=>Paquete::findOrFail($id)]);
    }
    public function update(PaqueteFormRequest $request,$id)
    {
    	$paquete=Paquete::findOrFail($id);
    	$paquete->descripcion=$request->get('descripcion');
    	$paquete->cantidad=$request->get('cantidad');
    	$paquete->update();
    	return Redirect::to('inventario/paquete');
    }
    public function destroy($id)
    {
    	$paquete=Paquete::findOrFail($id);
    	$paquete->estado='0';
    	$paquete->update();
    	return Redirect::to('inventario/paquete');
    }
}
