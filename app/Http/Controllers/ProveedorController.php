<?php

namespace saparicio\Http\Controllers;

use Illuminate\Http\Request;
use saparicio\Http\Requests;
use saparicio\Http\Requests\ProveedorFormRequest;
use saparicio\Proveedor;
use Illuminate\Support\Facades\Redirect;
use DB;

class ProveedorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function __construct()
    {
        $this->middleware('auth');
       $this->middleware('permission:compras.proveedor.create')->only(['create','store']);
        $this->middleware('permission:compras.proveedor.index')->only(['index']);
    $this->middleware('permission:compras.proveedor.edit')->only(['edit','update']);
       $this ->middleware('permission:compras.proveedor.show')->only(['show']);
        $this->middleware('permission:compras.proveedor.destroy')->only(['destroy']);
    }
    public function index(Request $request)
    {   //para buscar
        if($request)
        {//obtenga todo el registro
            $query=trim($request->get('searchText'));
            $proveedores=DB::table('Proveedor')->where('nombre','LIKE','%'.$query.'%')
            ->where('estado','=','1')
            ->orderBy('idProveedor','desc')
            ->paginate(7);

            return view('compras.proveedor.index',["proveedores"=>$proveedores,"searchText"=>$query]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("compras.proveedor.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProveedorFormRequest $request)
    {
            $proveedor= new Proveedor;
            $proveedor->nombre=$request->get('nombre');
            $proveedor->limiteCredito=$request->get('limiteCredito');
            $proveedor->debe=$request->get('debe');
            $proveedor->haber=$request->get('haber');
            $proveedor->estado='1';
            $proveedor->save();
            return Redirect::to('compras/proveedor');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view("compras.proveedor.show",["proveedores"=>Proveedor::findOrFail($id)]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view("compras.proveedor.edit",["proveedores"=>Proveedor::findOrFail($id)]); //proveedores busca si existe o no el prarametro enviado por el INDEX  boton edit
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProveedorFormRequest $request, $id)
    {
        $proveedor=Proveedor::findOrFail($id);
        $proveedor->nombre=$request->get('nombre');
        $proveedor->debe=$request->get('debe');
        $proveedor->haber=$request->get('haber');
        $proveedor->limiteCredito=$request->get('limiteCredito');
        $proveedor->update();
        return Redirect::to('compras/proveedor');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
          $proveedor=Proveedor::findOrFail($id);
          $proveedor->estado='0';
          $proveedor->update();
           return Redirect::to('compras/proveedor');
    }
}
