@extends ('layouts.admin')
@section ('contenido')

        
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
             <div class="form-group">            
               <label for="">CI:</label>
               <p>{{$cliente -> ci}}</p>
            </div>
        </div>
          
        <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
             <div class="form-group">            
               <label for="nombre">Nombre:</label>
                <p>{{$cliente -> nombreCliente}}</p>
        </div>
        <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
            <div class="form-group">            
               <label for="fechanac">Fecha Naciemiento </label>
                <p>{{$cliente -> fechaNac}}</p>            
            </div>
        </div>
        </div>
        <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
            <div class="form-group">            
               <label for="tipo">Tipo de Cliente </label>
                <p>{{$cliente -> tipo}}</p>            
            </div>
        </div>
        <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
            <div class="form-group">            
               <label for="fecha">Fecha Union </label>
                <p>{{$cliente ->fechaUnion}}</p>            
            </div>
        </div>
        <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
            <div class="form-group">            
               <label for="estado">Estado </label>
                <p>{{$cliente -> estado}}</p>            
            </div>
        </div>
              
</div>
    <div class="row">
       
       <div class="panel panel-primary">
           <div class="panel-body">               
                <div class="col-xs-4 col-sm-4 col-md-4 col-lg-12">
                    <table id="zona" class="table table-striped table-bordered table-condensed table-hover">
                        <thead style="background-color: #A9D0F5">                            
                             <th>Zona</th>
                              <th>Direccion</th>
                               <th>Observaciones</th>
                        </thead>
                        <tbody>
                         @foreach($zona as  $det)
                                <tr>
                                    <td>{{$det ->zona}}</td>    
                                    <td>{{$det ->direccion}}</td>
                                    <td>{{$det ->obs}}</td>
                                                                       
                                </tr>
                        @endforeach
                          
                        </tbody>
                    </table>
                </div>
           </div>
       </div>
       
    </div>                        

@endsection