<?php

namespace saparicio\Http\Controllers;

use Illuminate\Http\Request;
use saparicio\Http\Requests;
use saparicio\Zona;
use Illuminate\Support\Facades\Redirect;
use saparicio\Http\Requests\ZonaFormRequest;
use DB;
class ZonaController extends Controller
{
      public function __construct()
    {
       $this->middleware('auth');
       $this->middleware('permission:ventas.zona.create')->only(['create','store']);
        $this->middleware('permission:ventas.zona.index')->only(['index']);
    $this->middleware('permission:ventas.zona.edit')->only(['edit','update']);
       $this ->middleware('permission:ventas.zona.show')->only(['show']);
        $this->middleware('permission:ventas.zona.destroy')->only(['destroy']);
    }
    public function index(Request $request)
    {
    	if ($request)
    	{//obtenga todo el registro 
    		$query=trim($request->get('searchText'));
    		$zonas=DB::table('Zona')->where('nombre','LIKE','%'.$query.'%')
    		->where('estado','=','1')
    		->orderBy('idZona','desc')
    		->paginate(7);

    		return view('ventas.zona.index',["zonas"=>$zonas,"searchText"=>$query]);
    	}
    }
    public function create()
    {
    	return view("ventas.zona.create");
    	
    }
    /*crea un objeto TipoBebida*/
    public function store(ZonaFormRequest $request)
    {
    	$zonas=new Zona;
    	$zonas->nombre=$request->get('nombre');//esta en tipobebida forma request
            $zonas->estado='1';
    	$zonas->save();//guarda en la base de datos

            //return view('ventas/cargo');
    	return Redirect::to('ventas/zona');
    }

    public function show($id)//VERIFICAR LO ULTIMO
    {
    	return view("ventas.zona.show",["zonas"=>Zona::findOrFail($id)]);//Modelo TipoBebida
    }

    public function edit($id)
    {
    	
    	return view("ventas.zona.edit",["zonas"=>Zona::findOrFail($id)]);
    }
    public function update(ZonaFormRequest $request,$id)
    {
    	$zonas=Zona::findOrFail($id);
    	$zonas->nombre=$request->get('nombre');
    	$zonas->update();
    	return Redirect::to('ventas/zona');
    }
    public function destroy($id)
    {
    	$zonas=Zona::findOrFail($id);
            $zonas->estado='0';
    	$zonas->update();
    	return Redirect::to('ventas/zona');
    }
}
