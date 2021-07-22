<?php

namespace saparicio\Http\Controllers;

use Illuminate\Http\Request;
use saparicio\Http\Requests;
use saparicio\Http\Requests\IngresoFormRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;

use saparicio\Ingreso;
use saparicio\DetalleIngreso;

use DB;
use Carbon\Carbon;
use Response;
use Illuminate\Support\Collection;
use Illuminate\Database\Query\Builder;

class IngresoController extends Controller
{
   public function __construct()
    {
        $this->middleware('auth');
       $this->middleware('permission:compras.ingreso.create')->only(['create','store']);
        $this->middleware('permission:compras.ingreso.index')->only(['index']);
    $this->middleware('permission:compras.ingreso.edit')->only(['edit','update']);
       $this ->middleware('permission:compras.ingreso.show')->only(['show']);
        $this->middleware('permission:compras.ingreso.destroy')->only(['destroy']);
    }
     //index 
    public function index(Request $request)
    {
      if($request)
      {
        //almacenar la busqueda 
        $querry =  trim ($request -> get('searchText'));
        //obtener las categorias
        $ingresos = DB::table('Ingreso as i') 
        -> join('Proveedor as pv','i.idProveedor','=','pv.idProveedor')
        -> join('detalleingreso as di','i.idIngreso','=','di.idIngreso')
        -> select('i.idIngreso', 'i.fecha', 'pv.nombre','i.tipoComprobante', 'i.serieComprobante', 'i.numComprobante','i.impuesto','i.estado', DB::raw('sum(di.cantidad*precioCompra) as total1'))
        -> where('i.numComprobante','LIKE','%'.$querry.'%')         
        -> orderBy('i.idIngreso', 'asc')
        -> groupBy('i.idIngreso', 'i.fecha', 'pv.nombre', 'i.tipoComprobante', 'i.serieComprobante', 'i.numComprobante','i.impuesto','i.estado')
        -> paginate(7);
        
        return view('compras.ingreso.index', ["ingresos" => $ingresos, "searchText" => $querry]);
      }
    }

    //create (mostra la vista de crear)
    public function create()
    {
      $proveedores = DB::table('proveedor')->get();// ->where('tipoPersona', '=', 'Proveedor') -> get();
      $productos = DB::table('Producto as p')
      ->join('marca as ma','p.idmarca','=','ma.idmarca')
      ->join('sabor as sa','p.idsabor','=','sa.idsabor')
      ->join('medida as me','p.idmedida','=','me.idmedida')
      ->join('paquete as pa','p.idpaquete','=','pa.idpaquete')
      ->join('tipoenvase as tie','p.idtipoenvase','=','tie.idtipoenvase')
      ->join('tipobebida as tib','p.idtipobebida','=','tib.idtipobebida')
      -> select(DB::raw('CONCAT (ma.nombre," - ",me.medida," - ",sa.nombre," - ",pa.cantidad," - ",tie.tipo," - ",tib.tipo) AS  producto'), 'p.idProd')
      -> where ('p.estado', '=', 'Activo')
      -> get();

      return view('compras.ingreso.create', ['proveedores' => $proveedores, 'productos' => $productos]);
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
    public function store(IngresoFormRequest $request)
    {
      
 try {

        DB::beginTransaction();

        $ingreso = new Ingreso;     
        $ingreso -> idProveedor = $request -> get('idProveedor');//este valor es el que se encuentra en el formulario
        $ingreso -> tipoComprobante = $request -> get('tipoComprobante');
        $ingreso -> serieComprobante = $request -> get('serieComprobante');
        $ingreso -> numComprobante = $request -> get('numComprobante');
        $mytime = Carbon::now('America/La_Paz');
        $ingreso -> fecha= $mytime -> toDateTimeString();
        $ingreso -> impuesto = '16';
        $ingreso -> estado = 'Aceptado';        
        $ingreso -> save();
// recibo esto del formulario
        $idProductos  = $request -> get('idProd');
        $cantidad = $request -> get('cantidad');
        $precioCompra = $request -> get('precioCompra');
        $precioVenta = $request -> get('precioVenta');// Verificar
        $cont=0;

        while($cont < count ($idProductos)){

            $detalle = new DetalleIngreso();
            $detalle -> idIngreso = $ingreso -> idIngreso;
            $detalle -> idProd = $idProductos[$cont];
            $detalle -> cantidad = $cantidad[$cont];
            $detalle -> precioCompra = $precioCompra[$cont];
            $detalle -> precioVenta = $precioVenta[$cont];//Verificar
            $detalle -> save();
            
            $cont = $cont+1;
        }

        DB::commit();

    } catch (\Exception $e) {
        DB::rollback();
    }

      return Redirect::to('compras/ingreso');
    }

    //show
    public function show ($id){
        $ingreso =  DB::table('Ingreso as i') 
        -> join('Proveedor as pv','i.idProveedor','=','pv.idProveedor')
        -> join('detalleingreso as di','i.idIngreso','=','di.idIngreso')
        -> select('i.idIngreso','i.fecha', 'pv.nombre','i.tipoComprobante', 'i.serieComprobante', 'i.numComprobante','i.impuesto','i.estado',
          DB::raw('sum(di.cantidad*precioCompra) as total'))
        ->where ('i.idIngreso','=', $id)
        ->first();// CONFIGURAR EN CONFIG/ DATABASE/ strict = false;
        

        $detalles = DB::table('detalleIngreso as d') 
         -> join('producto as p','d.idProd','=','p.idProd')
         ->join('marca as ma','p.idmarca','=','ma.idmarca')
        ->join('sabor as sa','p.idsabor','=','sa.idsabor')
        ->join('medida as me','p.idmedida','=','me.idmedida')
        ->join('paquete as pa','p.idpaquete','=','pa.idpaquete')
        ->join('tipoenvase as tie','p.idtipoenvase','=','tie.idtipoenvase')
        ->join('tipobebida as tib','p.idtipobebida','=','tib.idtipobebida')
         -> select(DB::raw('CONCAT (ma.nombre," - ",me.medida," - ",sa.nombre," - ",pa.cantidad," - ",tie.tipo," - ",tib.tipo) AS  producto'), 'd.cantidad', 'd.precioCompra', 'd.precioVenta')
         -> where ('d.idIngreso', '=', $id) 
         -> get();

         return view('compras.ingreso.show', ['ingreso' => $ingreso, 'detalles' => $detalles]);
    }

    //update (actualizar un registro)
    

    //destroy (eliminar logicamente un registro)
    public function destroy($id)
    {
      $ingreso = Ingreso::findOrFail($id);
      $ingreso -> estado = 'Cancelado'; 
      $ingreso -> update();

      return Redirect::to('compras/ingreso');
    }

}