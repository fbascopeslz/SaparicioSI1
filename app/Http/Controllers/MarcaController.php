<?php

namespace saparicio\Http\Controllers;

use Illuminate\Http\Request;
use saparicio\Http\Requests;
use saparicio\Marca;//hace referencia al modelo app/.
use Illuminate\Support\Facades\Redirect;
use saparicio\Http\Requests\MarcaFormRequest;
use DB;
class MarcaController extends Controller
{
     public function __construct()
    {
        $this->middleware('auth');
       $this->middleware('permission:inventario.marca.create')->only(['create','store']);
        $this->middleware('permission:inventario.marca.index')->only(['index']);
    $this->middleware('permission:inventario.marca.edit')->only(['edit','update']);
       $this ->middleware('permission:inventario.marca.show')->only(['show']);
        $this->middleware('permission:inventario.marca.destroy')->only(['destroy']);
    }
    public function index(Request $request)
    {
    	if ($request)
    	{//obtenga todo el registro 
    		$query=trim($request->get('searchText'));
    		$marcas=DB::table('Marca')->where('nombre','LIKE','%'.$query.'%')
    		->where('estado','=','1')
    		->orderBy('idMarca','desc')
    		->paginate(7);

    		return view('inventario.marca.index',["marcas"=>$marcas,"searchText"=>$query]);
    	}
    }
    public function create()
    {
    	return view("inventario.marca.create");
    	
    }
    /*crea un objeto TipoBebida*/
    public function store(MarcaFormRequest $request)
    {
    	$marcas=new Marca;
    	$marcas->nombre=$request->get('nombre');//esta en tipobebida forma request
    	$marcas->estado='1';
    	$marcas->save();//guarda en la base de datos

            //return view('inventario/marca');
    	return Redirect::to('inventario/marca');
    }

    public function show($id)//VERIFICAR LO ULTIMO
    {
    	return view("inventario.marca.show",["marcas"=>Marca::findOrFail($id)]);//Modelo TipoBebida
    }

    public function edit($id)
    {
    	
    	return view("inventario.marca.edit",["marcas"=>Marca::findOrFail($id)]);
    }
    public function update(MarcaFormRequest $request,$id)
    {
    	$marcas=Marca::findOrFail($id);
    	$marcas->nombre=$request->get('nombre');
    	$marcas->update();
    	return Redirect::to('inventario/marca');
    }
    public function destroy($id)
    {
    	$marcas=Marca::findOrFail($id);
    	$marcas->estado='0';
    	$marcas->update();
    	return Redirect::to('inventario/marca');
    }
}
