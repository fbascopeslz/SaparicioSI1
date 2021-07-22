<?php

namespace saparicio\Http\Controllers;

use Illuminate\Http\Request;
use saparicio\Http\Requests;

use Illuminate\Support\Facades\Redirect;
use saparicio\Http\Requests\ClienteFormRequest;

use saparicio\Persona;
use saparicio\Cliente;
use saparicio\Direccion;
use saparicio\Zona;

use DB;
use Carbon\Carbon;
use Response;
use Illuminate\Support\Collection;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\Auth;

class ClienteController extends Controller
{
     public function __construct()
    {
        $this->middleware('auth');
       $this->middleware('permission:ventas.cliente.create')->only(['create','store']);
        $this->middleware('permission:ventas.cliente.index')->only(['index']);
    $this->middleware('permission:ventas.cliente.edit')->only(['edit','update']);
       $this ->middleware('permission:ventas.cliente.show')->only(['show']);
        $this->middleware('permission:ventas.cliente.destroy')->only(['destroy']);
    }
     public function index(Request $request)
    {
      if($request)
      {
        //$ci = Auth::user()->ci;
        //almacenar la busqueda 
        $querry =  trim ($request -> get('searchText'));
        //obtener las categorias
        $clientes = DB::table('Cliente as c') 
        ->join('Persona as p','p.ci','=','c.ci')
        ->join('Direccion as d','d.ci','=','d.ci')
       // ->join('Zona as z','Direccion as c','z.idZona','=','c.idZona')
        -> select('c.ci', DB::raw('CONCAT(p.nombre," ", p.paterno," ",p.materno) as nombreCliente'),'c.tipo','d.direccion','c.estado' ,'p.telefono')
        -> where('c.ci','LIKE','%'.$querry.'%') ->where('c.estado','=','Activo')// ->where('c.ci','=',$ci)      
        -> orderBy('c.ci', 'asc')
        -> groupBy('c.ci','c.tipo','c.estado','p.telefono')
        -> paginate(7);
        
        return view('ventas.cliente.index', ["clientes" => $clientes, "searchText" => $querry]);
      }
    }

    //create (mostra la vista de crear)
    public function create()
    {
      $zonas = DB::table('zona')->where('estado','=','1')->get();
      return view('ventas.cliente.create', ['zonas' => $zonas]);
    }

    // //show (mostrar la vista de show)
    // public function show($id)
    // {
    //   return view ('compras.proveedor.show', ['persona' => Persona::findOrFail($id)]);
    // }

    // //edit (mostrar la vista de editar)
    // public function edit($id)
    // {
    //   return view ('compras.proveedor.edit', ['persona' => Persona::findOrFail($id)]);
    // }

    //store(insertar un registro)
    public function store(ClienteFormRequest $request)
    {
      
  try {

        DB::beginTransaction();
        $persona= new Persona;
        $persona -> ci =$request->get('ci');
        $persona-> nombre =$request->get('nombre');
        $persona-> paterno=$request->get('paterno');
        $persona-> materno=$request->get('materno');
        $persona-> sexo=$request->get('sexo');
        //$persona-> fechaNac=$request->get('fechaNac');
        $persona-> telefono=$request->get('telefono');
        $persona-> save();
        
        //---CLIENTE
        //Cliente
        $cliente = new Cliente;
        $cliente -> ci =$request->get('ci');
        $cliente -> tipo =$request->get('tipo');
         $mytime = Carbon::now('America/La_Paz');
        $cliente -> fechaUnion= $mytime -> toDateTimeString();
         $cliente -> estado = 'Activo';
        $cliente-> save();

        //Direccion
        
   //     $ciCliente -> ci -> $request->get('ci');
        $idZona=$request->get('idZona');
        $observa =$request->get('obs');
        $direc=$request->get('direccion');
        $cont=0;
// direcciones tipo formulario
        while ($cont < count($direc)){
            $direccion= new Direccion;
            $direccion-> ci = $request->get('ci');
            $direccion-> idZona= $idZona[$cont];
            $direccion-> obs= $observa[$cont];
            $direccion-> direccion= $direc[$cont];
            $direccion->save();
            $cont = $cont +1;
        }

       

        DB::commit();

    } catch (\Exception $e) {
        DB::rollback();
    }

      return Redirect::to('ventas/cliente');
    }

    //show 
    public function show ($id){
        $cliente =  DB::table('Cliente as c') 
        ->join('Persona as p','p.ci','=','c.ci')
        ->join('Direccion as d','d.ci','=','c.ci')
       // ->join('Zona as z','Direccion as c','z.idZona','=','c.idZona')
        -> select('c.ci', DB::raw('CONCAT(p.nombre," ", p.paterno," ",p.materno) as nombreCliente'),'c.tipo','d.direccion','p.telefono','c.estado','c.fechaUnion','p.fechaNac')
        ->where ('c.ci','=', $id)
        ->first();// CONFIGURAR EN CONFIG/ DATABASE/ strict = false;

         $direccion = DB::table('direccion as d') 
         ->join('cliente as c','d.ci','=','c.ci')
         ->join('Zona as z','d.idZona','=','z.idZona')
         -> select('z.nombre as zona','d.direccion as direccion','d.obs')
         -> where ('d.ci', '=', $id) 
         -> get();
         return view('ventas.cliente.show', ['cliente' => $cliente,'zona'=>$direccion]);
    }

    //update (actualizar un registro)
    

    //destroy (eliminar logicamente un registro)
    public function destroy($id)
    {
      $cliente= Cliente::findOrFail($id);
      $cliente -> estado = 'Inactivo'; 
      $cliente -> update();

      return Redirect::to('ventas/cliente');
    }
}
