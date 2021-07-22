@extends ('layouts.admin')
@section ('contenido')

        
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
             <div class="form-group">            
               <label for="nombre">Cliente:</label>
               <p>{{$pedido -> nombrec}}</p>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
             <div class="form-group">            
               <label for="nombre">Promotor:</label>
               <p>{{$promotor -> nombrep}}</p>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
             <div class="form-group">            
               <label for="nombre">fecha:</label>
               <p>{{$pedido -> fecha}}</p>
            </div>
        </div>
        
</div>
    <div class="row">
       
       <div class="panel panel-primary">
           <div class="panel-body">               
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <table id="detalles" class="table table-striped table-bordered table-condensed table-hover">
                        <thead style="background-color: #A9D0F5">                            
                            <th>Producto</th>
                            <th>Cantidad</th>
                            <th>Precio</th>                             
                            <th>Subtotal</th>
                        </thead>
                        <tfoot>                            
                            <th></th>
                              <th></th>
                            <th></th>                            
                            <th><h4 id="total">total:/ {{$pedido -> total}}</h4></th>
                        </tfoot>
                        <tbody>
                            @foreach($detalles as  $det)
                                <tr>
                                    <td>{{$det -> producto}}</td>
                                    <td>{{$det -> cantidad}}</td>
                                    <td>{{$det -> precio}}</td>                               
                                    <td>{{$det -> cantidad * $det -> precio}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
           </div>
       </div>
       
    </div>                        

@endsection