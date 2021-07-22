<?php

namespace saparicio\Http\Controllers;

use Illuminate\Http\Request;
use saparicio\Http\Requests;
use saparicio\Almacen;
use Illuminate\Support\Facades\Redirect;
use saparicio\Http\Requests\AlmacenFormRequest;
use Illuminate\Support\Facades\Auth; // para acceder a datos del usuarios autenticado / o id
use DB;
class AlmacenController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
       $this->middleware('permission:inventario.almacen.create')->only(['create','store']);
        $this->middleware('permission:inventario.almacen.index')->only(['index']);
    $this->middleware('permission:inventario.almacen.edit')->only(['edit','update']);
       $this ->middleware('permission:inventario.almacen.show')->only(['show']);
        $this->middleware('permission:inventario.almacen.destroy')->only(['destroy']);
    }
    public function index(Request $request)
    {
    	if ($request)
    	{ 
    		$query=trim($request->get('searchText'));
    		$almacen=DB::table('almacen')->where('idAlmacen','LIKE','%'.$query.'%')
    		->orderBy('idAlmacen','desc')
    		->paginate(7);

    		return view('inventario.almacen.index',["almacen"=>$almacen,"searchText"=>$query]);
    	}
    }
    public function create()
    {
    	return view("inventario.almacen.create");
    	
    }
    /*crea un objeto TipoBebida*/
    public function store(AlmacenFormRequest $request)
    {
    	$almacen=new almacen;
    	$almacen->descripcion=$request->get('descripcion');//esta en tipobebida forma request 	
    	$almacen->ubicacion=$request->get('ubicacion');
    	$almacen->save();//guarda en la base de datos

    	return Redirect::to('inventario/almacen');
    }

    public function show($id)//VERIFICAR LO ULTIMO
    {
    	return view("inventario.almacen.show",["almacen"=>Almacen::findOrFail($id)]);//Modelo TipoBebida
    }

    public function edit($id)
    {
    	
    	return view("inventario.almacen.edit",["almacen"=>Almacen::findOrFail($id)]);
    }
    public function update(AlmacenFormRequest $request,$id)
    {
    	$almacen=almacen::findOrFail($id);
    	$almacen->descripcion=$request->get('descripcion');//esta en tipobebida forma request 	
    	$almacen->ubicacion=$request->get('ubicacion');
    	$almacen->update();
    	return Redirect::to('inventario/almacen');
    }
    public function destroy($id)
    {
    	$almacen=Almacen::findOrFail($id)->delete();
    	return Redirect::to('inventario/almacen');
    }
}
