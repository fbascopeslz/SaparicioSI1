<?php

namespace saparicio\Http\Controllers;

use Illuminate\Http\Request;
use saparicio\Http\Requests;
use saparicio\ZonaEmpleado;
use saparicio\Persona;
use Illuminate\Support\Facades\Redirect;
use saparicio\Http\Requests\ZonaEmpleadoFormRequest;
use DB;


class ZonaEmpleadoController extends Controller
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
    		$zonas=DB::table('ZonaEmpleado as ze')
    		->join('empleado as em','em.ci','=','ze.ci')
    		->join('users as us','em.ci','=','us.ci')
    		->join('zona as zn','zn.idZona','=','ze.idZona')
    		->join('cargo as ca','ca.idcargo','=','em.idcargo')
    		->select('em.ci as ci','us.name as nombre', 'ca.cargo','zn.nombre as zona')
    		->where('us.name','LIKE','%'.$query.'%')
    		->orwhere('zn.nombre','LIKE','%'.$query.'%')
    		->orderBy('ze.ci','desc')
    		->paginate(7);

    		return view('personal.zonaempleado.index',["zonaem"=>$zonas,"searchText"=>$query]);
    	}
    }
    public function create()
    {
    	$zona=DB::table('Zona')->get();
        	$empleado=DB::table('empleado')
        	->join('users as us','us.ci','=','empleado.ci')
        	
        	->get();
    	return view("personal.zonaempleado.create",["zona"=>$zona, "empleado"=>$empleado]);
    	
    }
    /*crea un objeto TipoBebida*/
    public function store(ZonaEmpleadoFormRequest $request)
    {
            $cont =0;
            $dias=$request->get('dias');
            $dia="";
            while ($cont < count($dias))
            {
                $dia=$dia." ".$dias[$cont];
                $cont= $cont+1;
            }
            $zonas=new ZonaEmpleado;
            $zonas ->dias=$dia;
            $zonas->ci=$request->get('ci');
            $zonas->idZona=$request->get('idzona');
            $zonas->save();
         
           	
    	//guarda en la base de datos

            //return view('ventas/cargo');
    	return Redirect::to('personal/zonaempleado');
    }

    public function show($id)//VERIFICAR LO ULTIMO
    {
    	return view("personal.eonaempleado.show",["zonaem"=>zonaempleado::findOrFail($id)]);//Modelo TipoBebida
    }

    public function edit($id)
    {
    	$zona=DB::table('zona')->get();       
            
    	return view("personal.zonaempleado.edit",["zona"=>$zona,"empleado"=>persona::findOrFail($id),"zonaem"=>zonaempleado::findOrFail($id)]);	
    }

    public function update(ZonaEmpleadoFormRequest $request,  $id)
    {
               $cont =0;
            $dias=$request->get('dias');
            $dia="";
            while ($cont < count($dias))
            {
                $dia=$dia." ".$dias[$cont];
                $cont= $cont+1;
            }

    	$zonas=ZonaEmpleado::findOrFail($id);
    	  $zonas ->dias=$dia;
            
            $zonas->idZona=$request->get('idzona');
    	$zonas->update();
    	return Redirect::to('personal/zonaempleado');

    }
    public function destroy($id)
    {
    	$zonas=ZonaEmpleado::findOrFail($id)->delete();
    	return back();
    	//return Redirect::to('personal/zonaempleado');
    }
}
