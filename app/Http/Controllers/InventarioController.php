<?php

namespace saparicio\Http\Controllers;

use Illuminate\Http\Request;
use saparicio\Http\Requests;
use saparicio\Inventario;//hace referencia al modelo app/Producto
use saparicio\Producto;//hace referencia al modelo app/Producto
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use saparicio\Http\Requests\InventarioFormRequest;
use DB;
use Response;
use Illuminate\Support\Collection;
use Illuminate\Database\Query\Builder;

class InventarioController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
       $this->middleware('permission:inventario.create')->only(['create','store']);
        $this->middleware('permission:inventario.index')->only(['index']);
    $this->middleware('permission:inventario.edit')->only(['edit','update']);
       $this ->middleware('permission:inventario.show')->only(['show']);
        $this->middleware('permission:inventario.destroy')->only(['destroy']);
    }
    public function index(Request $request)
    {
        if ($request)//se creo request
        {
            $query=trim($request->get('searchText'));//
            $productos=DB::table('producto as p')
            ->join('inventario as in','in.idProd','=','p.idProd')
            ->join('TipoBebida as tib', 'p.idTipoBebida','=','tib.idTipoBebida')
            ->join('TipoEnvase as tie', 'p.idTipoEnvase','=','tie.idTipoEnvase')
            ->join('Paquete as pa', 'p.idPaquete','=','pa.idPaquete')           
            ->join('Medida as me', 'p.idMedida','=','me.idMedida')
            ->join('Marca as ma', 'p.idMarca','=','ma.idMarca')
            ->join('Sabor as sa', 'p.idSabor','=','sa.idSabor')
	-> select(DB::raw('CONCAT (ma.nombre," - ",me.medida," - ",sa.nombre," - ",pa.cantidad," - ",tie.tipo," - ",tib.tipo) AS  producto'), 'p.idProd','in.stock as stock','in.minStock as minStock','in.maxStock as maxStock','p.imagen','p.descripcion')
            ->where('p.descripcion','LIKE','%'.$query.'%')
            ->orwhere('p.idProd','LIKE','%'.$query.'%')
            ->orderBy('p.idProd','desc')
            ->paginate(7);
            return view('inventario.index',["productos"=>$productos,"searchText"=>$query]);

        }
    }
    public function create()
    {   //crea listado de tipobebida para mostrarlos en un combobox
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

        
        $almacen=DB::table('Almacen')->get();
        return view("inventario.create",
            [
            "productos"=>$productos,
            "almacen"=>$almacen
            ]);
    }
    //almacena el objeto categoria en la tabla categoria de la db
    public function store (InventarioFormRequest $request)
    {
        $inventario=new Inventario;// esta en provides (es modelo)
       //$inventario->descripcion=$request->get('descripcion');
        $inventario->idProd=$request->get('idProd');
        $inventario->stock=$request->get('stock');
        $inventario->minStock=$request->get('minStock');
        $inventario->maxStock=$request->get('maxStock');
        $inventario->idAlmacen = $request->get('idAlmacen');     
        $inventario->save();
        return Redirect::to('inventario'); //redirecciona a la vista 
    }
    //se usara para ver detalles del prodcuto
    public function show($id)
    {
        return view("inventario.show",["producto"=>Producto::findOrFail($id)]);
    }
    //modifica los datos de un producto especifica
    public function edit($id)
    {
        $inventario=Inventario::findOrFail($id);
         $almacen=DB::table('Almacen')->get();
        $productos = DB::table('producto as p')
      ->join('marca as ma','p.idmarca','=','ma.idmarca')
      ->join('sabor as sa','p.idsabor','=','sa.idsabor')
      ->join('medida as me','p.idmedida','=','me.idmedida')
      ->join('paquete as pa','p.idpaquete','=','pa.idpaquete')
      ->join('tipoenvase as tie','p.idtipoenvase','=','tie.idtipoenvase')
      ->join('tipobebida as tib','p.idtipobebida','=','tib.idtipobebida')
      -> select(DB::raw('CONCAT (ma.nombre," - ",me.medida," - ",sa.nombre," - ",pa.cantidad," - ",tie.tipo," - ",tib.tipo) AS  producto'), 'p.idProd','p.descripcion as descripcion')
      -> where ('p.estado', '=', 'Activo')
      -> where('p.idProd','=',$id)
      -> first();
        return view("inventario.edit",
            [
            "productos"=>$productos,
            "inventario"=>$inventario,
            "almacen"=>$almacen
                    
            ]);
    }
    public function update(InventarioFormRequest $request,$id)
    {
        $inventario=Inventario::findOrFail($id);
        $inventario->idProd=$id;
        $inventario->stock=$request->get('stock');
        $inventario->minStock=$request->get('minStock');
        $inventario->maxStock=$request->get('maxStock');
        $inventario->idAlmacen = $request->get('idAlmacen');
        $inventario->update();
        return Redirect::to('inventario');//lllamar a lavista 
    }
    public function destroy($id)
    {
        $inventario = Inventario::findOrFail($id)->delete();
        return Redirect::to('inventario');
    }
 }
