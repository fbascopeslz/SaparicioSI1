<?php

namespace saparicio\Http\Controllers;

use Illuminate\Http\Request;
use saparicio\Http\Requests;
use saparicio\Producto;//hace referencia al modelo app/Producto
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use saparicio\Http\Requests\ProductoFormRequest;
use DB;
class ProductoController extends Controller
{
     public function __construct()
    {
        $this->middleware('auth');
       $this->middleware('permission:inventario.producto.create')->only(['create','store']);
      //  $this->middleware('permission:inventario.producto.index')->only(['index']);
    $this->middleware('permission:inventario.producto.edit')->only(['edit','update']);
       $this ->middleware('permission:inventario.producto.show')->only(['show']);
        $this->middleware('permission:inventario.producto.destroy')->only(['destroy']);
    }
    public function index(Request $request)
    {
        if ($request)//se creo request
        {
            $query=trim($request->get('searchText'));//
            $productos=DB::table('producto as p')
            ->join('TipoBebida as tib', 'p.idTipoBebida','=','tib.idTipoBebida')
            ->join('TipoEnvase as tie', 'p.idTipoEnvase','=','tie.idTipoEnvase')
            ->join('Paquete as pa', 'p.idPaquete','=','pa.idPaquete')           
            ->join('Medida as me', 'p.idMedida','=','me.idMedida')
            ->join('Marca as ma', 'p.idMarca','=','ma.idMarca')
            ->join('Sabor as sa', 'p.idSabor','=','sa.idSabor')

            ->select('p.idProd','p.descripcion','p.precio','p.estado','p.imagen',
                'tib.tipo as tipoProducto',
                'tib.tipo as tipoBebida',//verificar estoy por el video 12
                'tie.tipo as tipoEnvase',
                'pa.cantidad as paquete',
                'me.medida as medida',
                'ma.nombre as marca',
                'sa.nombre as sabor')
            ->where('p.descripcion','LIKE','%'.$query.'%')
            ->orwhere('p.idProd','LIKE','%'.$query.'%')
            ->orderBy('p.idProd','desc')
            ->paginate(7);
            return view('inventario.producto.index',["productos"=>$productos,"searchText"=>$query]);

        }
    }
    public function create()
    {   //crea listado de tipobebida para mostrarlos en un combobox
        $tipobebidas=DB::table('TipoBebida')->where('estado','=','1')->get();
        $tipoenvases=DB::table('TipoEnvase')->where('estado','=','1')->get();
        $paquetes=DB::table('Paquete')->where('estado','=','1')->get();
        $medidas=DB::table('Medida')->where('estado','=','1')->get();
        $marcas=DB::table('Marca')->where('estado','=','1')->get();
        $sabores=DB::table('Sabor')->where('estado','=','1')->get();
        return view("inventario.producto.create",
            ["tipobebidas"=>$tipobebidas,
            "tipoenvases"=>$tipoenvases,
            "paquetes"=>$paquetes,
            "medidas"=>$medidas,
            "marcas"=>$marcas,
            "sabores"=>$sabores]);
    }
    //almacena el objeto categoria en la tabla categoria de la db
    public function store (ProductoFormRequest $request)
    {
        $producto=new Producto;// esta en provides (es modelo)
        $producto->descripcion=$request->get('descripcion');
        $producto->precio=$request->get('precio');
        $producto->estado='Activo';
        $producto->idSabor=$request->get('idsabor');
        $producto->idMedida=$request->get('idmedida');
        $producto->idPaquete=$request->get('idpaquete');
        $producto->idMarca=$request->get('idmarca');
        $producto->idTipoEnvase=$request->get('idtipoEnvase');
        $producto->idTipoBebida=$request->get('idtipoBebida');
        
        if (Input::hasFile('imagen')){ //prueba si existe la imagen
            $file=Input::file('imagen');//se lalmacena 
            $file->move(public_path().'/imagenes/producto/',$file->getClientOriginalName()); //file sea movido a public_path /imagenes/articulos/ $file es lo que va mover
            $producto->imagen=$file->getClientOriginalName();
        }
        $producto->save();
        return Redirect::to('inventario/producto'); //redirecciona a la vista 
    }
    //se usara para ver detalles del prodcuto
    public function show($id)
    {
        return view("inventario.producto.show",["producto"=>Producto::findOrFail($id)]);
    }
    //modifica los datos de un producto especifica
    public function edit($id)
    {
        $productos=Producto::findOrFail($id);
        $tipobebidas=DB::table('TipoBebida')->where('estado','=','1')->get();
        $tipoenvases=DB::table('TipoEnvase')->where('estado','=','1')->get();
        $paquetes=DB::table('Paquete')->where('estado','=','1')->get();
        $medidas=DB::table('Medida')->where('estado','=','1')->get();
        $marcas=DB::table('Marca')->where('estado','=','1')->get();
        $sabores=DB::table('Sabor')->where('estado','=','1')->get();
        return view("inventario.producto.edit",
            ["productos"=>$productos,
            "tipobebidas"=>$tipobebidas,
            "tipoenvases"=>$tipoenvases,
            "paquetes"=>$paquetes,
            "medidas"=>$medidas,
            "marcas"=>$marcas,
            "sabores"=>$sabores]);
    }
    public function update(ProductoFormRequest $request,$id)
    {
        $producto=Producto::findOrFail($id);
        $producto->descripcion=$request->get('descripcion');
        $producto->precio=$request->get('precio');
        $producto->estado='Activo';
        $producto->idSabor=$request->get('idsabor');
        $producto->idMedida=$request->get('idmedida');
        $producto->idPaquete=$request->get('idpaquete');
        $producto->idMarca=$request->get('idmarca');
        $producto->idTipoEnvase=$request->get('idtipoEnvase');
        $producto->idTipoBebida=$request->get('idtipoBebida');
        
        if (Input::hasFile('imagen')){ //prueba si existe la imagen
            $file=Input::file('imagen');//se lalmacena 
            $file->move(public_path().'/imagenes/producto/',$file->getClientOriginalName()); //file sea movido a public_path /imagenes/articulos/ $file es lo que va mover
            $producto->imagen=$file->getClientOriginalName();
        }       

        $producto->update();
        return Redirect::to('inventario/producto');//lllamar a lavista 
    }
    public function destroy($id)
    {
        $producto=Producto::findOrFail($id);
        $producto->estado='Inactivo';
        $producto->update();
        return Redirect::to('inventario/producto');
    }
}
