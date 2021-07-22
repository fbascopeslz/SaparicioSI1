<?php

namespace saparicio\Http\Controllers;

use Illuminate\Http\Request;

use saparicio\Http\Requests;
use DB;
use PDF;
class PdfController extends Controller
{
    public function index()
    {
        return view("pdf.listado_reportes");
    }
    public function crearPDF($datos,$vista,$tipo)
    {

        $data = $datos;
        $date = date('Y-m-d');
//        $view =  \View::make($vistaurl, compact('productos', 'date'))->render();
//        $pdf = \App::make('dompdf.wrapper');
//        $pdf->loadHTML($view);
        
        $pdf=PDF::loadView($vista,['datos'=>$data,'date'=>$date])->setPaper('a4', 'landscape');

        
        if($tipo==1){return $pdf->stream('reporte');}
        if($tipo==2){return $pdf->download('reporte.pdf'); }
    }
    public function crearPDF_Fechas($datos,$vista,$tipo,$fIni,$fFin)
    {

        $data = $datos;
        $date = date('Y-m-d');
//        $view =  \View::make($vistaurl, compact('productos', 'date'))->render();
//        $pdf = \App::make('dompdf.wrapper');
//        $pdf->loadHTML($view);
        
        $pdf=PDF::loadView($vista,['datos'=>$data,'date'=>$date,'fIni'=>$fIni,'fFin'=>$fFin])->setPaper('a4', 'landscape');

        
        if($tipo==1){return $pdf->stream('reporte');}
        if($tipo==2){return $pdf->download('reporte.pdf'); }
    }
     public function crear_reporte_producto($tipo){
          $vista='pdf.ReporteProductos';
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
                'sa.nombre as sabor')->get();
     
     return $this->crearPDF($productos,$vista,$tipo);
    }
    public function crear_reporte_ingresos($tipo)
    {
        
        $vista='pdf.ReporteIngresos';
        
        $querry='';
         $ingresos = DB::table('Ingreso as i') 
        -> join('Proveedor as pv','i.idProveedor','=','pv.idProveedor')
        -> join('detalleingreso as di','i.idIngreso','=','di.idIngreso')
        -> select('i.idIngreso', 'i.fecha', 'pv.nombre','i.tipoComprobante', 'i.serieComprobante', 'i.numComprobante','i.impuesto','i.estado', DB::raw('sum(di.cantidad*precioCompra) as total1'))
        -> where('i.numComprobante','LIKE','%'.$querry.'%')         
        -> orderBy('i.idIngreso', 'asc')
        -> groupBy('i.idIngreso', 'i.fecha', 'pv.nombre', 'i.tipoComprobante', 'i.serieComprobante', 'i.numComprobante','i.impuesto','i.estado')->get();
        return $this->crearPDF($ingresos,$vista,$tipo);
    }
    public function crear_reporte_inventario($tipo)
    {
        
        $vista='pdf.ReporteInventario';
        
        $query='';
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
            ->orderBy('p.idProd','desc')->get();
        return $this->crearPDF($productos,$vista,$tipo);
    }
    
    public function crear_reporte_pedidos($tipo)
    {
        
        $vista='pdf.ReportePedidos';
        
        $query='';
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
        -> groupBy('ve.idventa','ve.estado', 've.fecha','em.codigo')->get();
        return $this->crearPDF($ventas,$vista,$tipo);
    }
    
    
    public function crear_reporte_ingresos_fechas(){
        return view('pdf.ingresosFechas');
    }
    public function crear_reporte_ingresos_fechas_post(Request $request){
        $fIni=$request->get('fechaIni');
        $fFin=$request->get('fechaFin');
        $tipo=$request->get('tipo');
        $date = date('Y-m-d');
        
        $ingresos = DB::table('Ingreso as i') 
        -> join('Proveedor as pv','i.idProveedor','=','pv.idProveedor')
        -> join('detalleingreso as di','i.idIngreso','=','di.idIngreso')
        -> select('i.idIngreso', 'i.fecha', 'pv.nombre','i.tipoComprobante', 'i.serieComprobante', 'i.numComprobante','i.impuesto','i.estado', DB::raw('sum(di.cantidad*precioCompra) as total1'))
        -> where('i.fecha','>=',''.$fIni.'')->where('i.fecha','<=',''.$fFin.'')         
        -> orderBy('i.idIngreso', 'asc')
        -> groupBy('i.idIngreso', 'i.fecha', 'pv.nombre', 'i.tipoComprobante', 'i.serieComprobante', 'i.numComprobante','i.impuesto','i.estado')->get();
        
//        return view('pdf.ReporteIngresosConFechas',['datos'=>$ingresos,'fIni'=>$fIni,'fFin'=>$fFin,'date'=>$date]);
        return $this->crearPDF_Fechas($ingresos,'pdf.ReporteIngresosConFechas',$tipo,$fIni,$fFin);
    }

}
