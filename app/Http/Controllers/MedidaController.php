<?php

namespace saparicio\Http\Controllers;

use Illuminate\Http\Request;
use saparicio\Http\Requests;
use saparicio\Medida;//hace referencia al modelo app/TipoBebida
use Illuminate\Support\Facades\Redirect;
use saparicio\Http\Requests\MedidaFormRequest;


use DB;

class MedidaController extends Controller
{
  public function __construct()
    {
        $this->middleware('auth');
       $this->middleware('permission:inventario.medida.create')->only(['create','store']);
        $this->middleware('permission:inventario.medida.index')->only(['index']);
    $this->middleware('permission:inventario.medida.edit')->only(['edit','update']);
       $this ->middleware('permission:inventario.medida.show')->only(['show']);
        $this->middleware('permission:inventario.medida.destroy')->only(['destroy']);
    }
    public function index(Request $request)
    {
    	if ($request)
    	{//obtenga todo el registro 
    		$query=trim($request->get('searchText'));
    		$medidas=DB::table('Medida')->where('medida','LIKE','%'.$query.'%')
    		->where('estado','=','1')
    		->orderBy('idMedida','desc')
    		->paginate(7);

    		return view('inventario.medida.index',["medidas"=>$medidas,"searchText"=>$query]);
    	}
    }
    public function create()
    {
    	return view("inventario.medida.create");
    	
    }
    /*crea un objeto TipoBebida*/
    public function store(MedidaFormRequest $request)
    {
    	$medidas=new Medida;
    	$medidas->medida=$request->get('medida');//esta en tipobebida forma request
    	$medidas->estado='1';
    	$medidas->save();//guarda en la base de datos

    	return Redirect::to('inventario/medida');
    }

    public function show($id)//VERIFICAR LO ULTIMO
    {
    	return view("inventario.medida.show",["medidas"=>Medida::findOrFail($id)]);//Modelo TipoBebida
    }

    public function edit($id)
    {
    	
    	return view("inventario.medida.edit",["medidas"=>Medida::findOrFail($id)]);
    }
    public function update(MedidaFormRequest $request,$id)
    {
    	$medidas=Medida::findOrFail($id);
    	$medidas->medida=$request->get('medida');
    	$medidas->update();
    	return Redirect::to('inventario/medida');
    }
    public function destroy($id)
    {
    	$medida=Medida::findOrFail($id);
    	$medida->estado='0';
    	$medida->update();
    	return Redirect::to('inventario/medida');
    }
}
