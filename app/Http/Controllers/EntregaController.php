<?php

namespace saparicio\Http\Controllers;

use Illuminate\Http\Request;

use saparicio\Http\Requests;
use saparicio\Http\Requests\EntregaFormRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use saparicio\Entrega;
use saparicio\VentaProducto;

use DB;
use Carbon\Carbon;
use Response;
use Illuminate\Support\Collection;
use Illuminate\Database\Query\Builder;
class EntregaController extends Controller
{
     public function __construct()
    {
        $this->middleware('auth');
       $this->middleware('permission:ventas.entrega.create')->only(['create','store']);
        $this->middleware('permission:ventas.entrega.index')->only(['index']);
    $this->middleware('permission:ventas.entrega.edit')->only(['edit','update']);
       $this ->middleware('permission:ventas.entrega.show')->only(['show']);
        $this->middleware('permission:ventas.entrega.destroy')->only(['destroy']);
    }
     //index 
    public function index(Request $request)
    {
      if($request)
      {
        $cichofer= Auth::user()->ci;
      
        $querry =  trim ($request -> get('searchText'));
        //obtener las categorias
        $ventas = DB::table('venta as ve')
        ->join('Empleado as em','em.ci','=','ve.ciPromotor')
        ->join('Persona as pp','pp.ci','=','em.ci')

        ->join('Cliente as cl','cl.ci','=','ve.ciCliente')
        ->join('Persona as pc','pc.ci','=','cl.ci')
        ->join('VentaProducto as vp','vp.idventa','=','ve.idventa')
        ->select('ve.idventa as idventa','ve.estado','ve.fecha','em.codigo', DB::raw('CONCAT( pp.nombre," " ,pp.paterno) as nombrep') , DB::raw('CONCAT( pc.nombre," " ,pc.paterno) as nombrec')) 
         -> where('ve.idventa','LIKE','%'.$querry.'%')   
         ->where('ve.cichofer','=',$cichofer)
        -> orderBy('ve.idventa', 'asc')
        -> groupBy('ve.idventa','ve.estado', 've.fecha','em.codigo')
        -> paginate(7);
        return view('ventas.entrega.index', ["ventas" => $ventas, "searchText" => $querry]);
       }
    }

    //create (mostra la vista de crear)
    public function create()
    {
      $cliente = DB::table('cliente as cl')
      ->join('persona as pe','pe.ci','=','cl.ci')
      ->select('cl.ci',DB::raw('CONCAT( pe.nombre," " ,pe.paterno) as nombrec'))
      ->get();// ->where('tipoPersona', '=', 'Proveedor') -> get();

      $producto = DB::table('Producto as p')
      ->join('marca as ma','p.idmarca','=','ma.idmarca')
      ->join('sabor as sa','p.idsabor','=','sa.idsabor')
      ->join('medida as me','p.idmedida','=','me.idmedida')
      ->join('paquete as pa','p.idpaquete','=','pa.idpaquete')
      ->join('tipoenvase as tie','p.idtipoenvase','=','tie.idtipoenvase')
      ->join('tipobebida as tib','p.idtipobebida','=','tib.idtipobebida')
      -> select(DB::raw('CONCAT (ma.nombre," - ",me.medida," - ",sa.nombre," - ",pa.cantidad," - ",tie.tipo," - ",tib.tipo) AS  producto'), 'p.idProd','p.precio')
      -> where ('p.estado', '=', 'Activo')
      -> get();

      return view('ventas.entrega.create', ['cliente' => $cliente, 'productos' => $producto]);
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
    public function store(EntregaFormRequest $request)
    {
      
 /*try {

        DB::beginTransaction();
*/
        $venta = new Entrega;     
        $venta -> ciCliente = $request -> get('cicliente');
        $venta -> ciPromotor = Auth::user()->ci; //este valor es el que se encuentra en el formulario
        $mytime = Carbon::now('America/La_Paz');
        $venta -> fecha= $mytime -> toDateTimeString();
     //   $venta -> fechaentrega= $request->get('fechaentrega');
    //    $venta -> observacion = $request->get('observacion');
    //    $venta-> total = $request ->get('total');
        $venta -> estado = 'Aceptado';        
        $venta -> save();
// recibo esto del formulario
        $idProductos  = $request -> get('idProd');
        $cantidad = $request -> get('cantidad');
        $precio = $request -> get('precio');
        $descuento = $request->get('descuento');
      //  $total = $request -> get('total');// Verificar
     //   $importe = $request -> get('importe');// Verificar
        $cont=0;

        while($cont < count ($idProductos)){

            $detalle = new VentaProducto();
            $detalle -> idVenta = $venta -> idVenta;
            $detalle -> idProd = $idProductos[$cont];
            $detalle -> cantidad = $cantidad[$cont];
            $pre= $precio[$cont]-$descuento[$cont];
            $detalle -> precio = $pre;
        //    $detalle -> importe= $importe[$cont];//Verificar
            $detalle -> save();
            
            $cont = $cont+1;
        }
/*
        DB::commit();

    } catch (\Exception $e) {
        DB::rollback();
    }*/

      return Redirect::to('ventas/entrega');
    }

    //show
    public function show ($id){
        $entrega =  DB::table('Venta as ve') 
        -> join('Persona as p','p.ci','=','ve.ciCliente')
        -> join('VentaProducto as vp','ve.idventa','=','vp.idventa')
        -> select('ve.idventa','ve.fecha', DB::raw('CONCAT( p.nombre," ",p.paterno) as nombrec'),
          DB::raw('sum(vp.cantidad*vp.precio) as total'))
        ->where ('ve.idventa','=', $id)
        ->first();// CONFIGURAR EN CONFIG/ DATABASE/ strict = false;
        
        $promotor= DB::table('persona as p')
        ->join('venta as ve','p.ci','=','ve.ciPromotor')
        ->select(DB::raw('CONCAT( p.nombre," ",p.paterno) as nombrep'))
         ->where ('ve.idVenta','=', $id)
        ->first();

      $chofer= DB::table('persona as p')
        ->join('venta as ve','p.ci','=','ve.cichofer')
        ->select(DB::raw('CONCAT( p.nombre," ",p.paterno) as nombrech'))
         ->where ('ve.idVenta','=', $id)
        ->first();


        $detalles = DB::table('VentaProducto as vp') 
         -> join('producto as p','vp.idProd','=','p.idProd')
         ->join('marca as ma','p.idmarca','=','ma.idmarca')
        ->join('sabor as sa','p.idsabor','=','sa.idsabor')
        ->join('medida as me','p.idmedida','=','me.idmedida')
        ->join('paquete as pa','p.idpaquete','=','pa.idpaquete')
        ->join('tipoenvase as tie','p.idtipoenvase','=','tie.idtipoenvase')
        ->join('tipobebida as tib','p.idtipobebida','=','tib.idtipobebida')
         -> select(DB::raw('CONCAT (ma.nombre," - ",me.medida," - ",sa.nombre," - ",pa.cantidad," - ",tie.tipo," - ",tib.tipo) AS  producto'), 'vp.cantidad', 'vp.precio')
         -> where ('vp.idVenta', '=', $id) 
         -> get();
         return view('ventas.entrega.show', ['entrega' => $entrega, 'detalles' => $detalles,'promotor'=>$promotor, 'chofer'=>$chofer ]);
    }
   
    public function destroy($id)
    {
      $entrega = Entrega::find($id);
      $entrega -> estado ='Entregado';
      $entrega->update();      
      return Redirect::to('ventas/entrega');
    }
}
