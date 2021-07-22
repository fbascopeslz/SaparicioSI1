@extends ('layouts.admin')
@section ('contenido')
<div>parametros</div>

      

<div class="container">
 
 <form action="/crear_reporte_ingresos_fechas_post" method="POST">
 <input type="hidden" name="_token" value="{{ csrf_token() }}">
    
  <div class="col-md-2">
      <div>desde la fecha:</div>
  <input type="date" class="form-control" name="fechaIni"> 
  </div>  
 <div class="col-md-2">
      <div>hasta la fecha:</div>

       <input type="date" class="form-control" name="fechaFin"> 
     
 </div>
 <div class="col-md-2">
               <br>
                <a href="#" target="_blank"><button name="tipo" value="1" class="btn btn-primary" type="submit">ver</button></a>

 </div>
<div class="col-md-2">
                <br>
                 <button  name="tipo" value="2" class="btn btn-primary" type="submit">Descargar</button>

 </div>
</form>

       </div>
    
@endsection