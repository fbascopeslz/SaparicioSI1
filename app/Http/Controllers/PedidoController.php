<?php

namespace saparicio\Http\Controllers;

use Illuminate\Http\Request;

use saparicio\Http\Requests;
use saparicio\Http\Requests\PedidoFormRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use saparicio\Pedido;
use saparicio\VentaProducto;

use DB;
use Carbon\Carbon;
use Response;
use Illuminate\Support\Collection;
use Illuminate\Database\Query\Builder;
class PedidoController extends Controller
{
      public function __construct()
    {
        $this->middleware('auth');
       $this->middleware('permission:ventas.pedido.create')->only(['create','store']);
        $this->middleware('permission:ventas.pedido.index')->only(['index']);
    $this->middleware('permission:ventas.pedido.edit')->only(['edit','update']);
       $this ->middleware('permission:ventas.pedido.show')->only(['show']);
        $this->middleware('permission:ventas.pedido.destroy')->only(['destroy']);
    }
     //index 
    public function index(Request $request)
    {
      if($request)
      {
        $cipromotor= Auth::user()->ci;
        //almacenar la busqueda 
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
         ->where('ve.estado','=','Aceptado')
         ->where('ve.cipromotor','=',$cipromotor)
        -> orderBy('ve.idventa', 'asc')
        -> groupBy('ve.idventa','ve.estado', 've.fecha','em.codigo')
        -> paginate(7);
        return view('ventas.pedido.index', ["ventas" => $ventas, "searchText" => $querry]);
      }
    }

    //create (mostra la vista de crear)
    public function create()
    {
      $cliente = DB::table('cliente as cl')
      ->join('persona as pe','pe.ci','=','cl.ci')
      ->select('cl.ci',DB::raw('CONCAT( pe.nombre," " ,pe.paterno) as nombrec'))
      ->get();// ->where('tipoPersona', '=', 'Proveedor') -> get();



      $producto = DB::table('producto as p')
      ->join('marca as ma','p.idmarca','=','ma.idmarca')
      ->join('sabor as sa','p.idsabor','=','sa.idsabor')
      ->join('medida as me','p.idmedida','=','me.idmedida')
      ->join('paquete as pa','p.idpaquete','=','pa.idpaquete')
      ->join('tipoenvase as tie','p.idtipoenvase','=','tie.idtipoenvase')
      ->join('tipobebida as tib','p.idtipobebida','=','tib.idtipobebida')
      ->join('inventario as in','in.idProd','=','p.idProd')
      -> select(DB::raw('CONCAT (ma.nombre," - ",me.medida," - ",sa.nombre," - ",pa.cantidad," - ",tie.tipo," - ",tib.tipo) AS  producto'), 'p.idProd','p.precio', 'in.stock as stock')
      -> where ('p.estado', '=', 'Activo')
      -> get();
        
        
        
        
        
        
        
            
        

      return view('ventas.pedido.create', ['cliente' => $cliente, 'productos' => $producto]);
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
    public function store(PedidoFormRequest $request)
    {
      
 /*try {

        DB::beginTransaction();

*/  //VERIFICAR  
 $ciPr=Auth::user()->ci;
        $zonae=DB::table('zonaempleado as ze')->select('ze.idzona')->where('ze.ci','=',$ciPr)->first();
        $chofer= DB::table('empleado as em')
        ->join('zonaempleado as zec','zec.ci','=','em.ci')
        ->join('cargo as ca','ca.idCargo','=','em.idCargo')
        ->select('em.ci')
        ->where('ca.cargo','=','Chofer')
        ->where('zec.idzona','=',$zonae->idzona)
        ->first();

        $venta = new Pedido;     
        $venta -> ciCliente = $request -> get('cicliente');
        $venta -> ciPromotor = Auth::user()->ci;
       $venta->ciChofer = $chofer->ci; //este valor es el que se encuentra en el formulario
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

      return Redirect::to('ventas/pedido');
    }

    //show
    public function show ($id){
        $pedido =  DB::table('Venta as ve') 
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
         return view('ventas.pedido.show', ['pedido' => $pedido, 'detalles' => $detalles,'promotor'=>$promotor ]);
    }

    //update (actualizar un registro)
    

    //destroy (eliminar logicamente un registro)
    public function destroy($id)
    {
      $detalle = VentaProducto::find($id)->delete();
      $pedido = Pedido::find($id)->delete();
      
      return Redirect::to('ventas/pedido');
    }
}
