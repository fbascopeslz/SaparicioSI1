@extends ('layouts.admin')
@section ('contenido')
<div class="row">
    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
        <h3>Nuevo ingreso</h3>
        @if (count($errors) > 0)
        <div class="alert alert-danger">
	        <ul>
	            @foreach($errors -> all() as $error)
	                <li>{{$error}}</li>
	            @endforeach
	        </ul>
        </div>
        @endif
    </div>
</div>
        {{Form::open(array('url' => 'compras/ingreso', 'method' => 'POST', 'autocomplete' => 'off'))}}
        {{Form::token()}}
    <div class="row">
        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-12">
             <div class="form-group">            
               <label for="proveedor">Proveedor:</label>
               <select name="idProveedor" id="idProveedor" class="form-control selectpicker" data-Live-search="true">
                   @foreach($proveedores as $pv)
                       <option value="{{$pv-> idProveedor}}">{{$pv -> nombre}} </option>
                   @endforeach
               </select>
            </div>
        </div>
          
        <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
             <div class="form-group">            
               <label for="nombre">Tipo de comprobante:</label>
               <select name="tipoComprobante" id="" class="form-control">                  
                   <option value="Boleta">Boleta</option> 
                   <option value="Factura">Factura</option>
                   <option value="Ticket">Ticket</option>
               </select>
            </div>
        </div>
        <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
            <div class="form-group">            
               <label for="serieComprobante">Serie del comprobante:</label>
                <input type="text" class="form-control" name="serieComprobante" placeholder="Serie del comprobante..."  value="{{old('serieComprobante')}}">            
            </div>
        </div>
        <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
            <div class="form-group">            
               <label for="numComprobante">Numero del comprobante:</label>
                <input type="text" class="form-control" name="numComprobante" placeholder="Numero del comprobante..."  required value="{{old('numComprobante')}}">            
            </div>
        </div>
</div>
    <div class="row">
       
       <div class="panel panel-primary">
           <div class="panel-body">
              <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                    <div class="form-group">
                        <label for="">Producto</label>
                        <select class="form-control selectpicker" name="pidProd" id="pidProd" data-Live-search="true">
                            @foreach($productos as $producto)
                                <option value="{{$producto -> idProd}}">{{$producto -> producto}}</option>
                            @endforeach
                        </select>
                    </div>
               </div>
               <div class="col-xs-12 col-sm-2 col-md-2 col-lg-2">
                    <div class="form-group">            
                       <label for="cantidad">Cantidad:</label>
                        <input type="number" class="form-control" name="pcantidad" id="pcantidad" placeholder="cantidad">            
                    </div>
                </div>
                <div class="col-xs-12 col-sm-2 col-md-2 col-lg-2">
                    <div class="form-group">            
                       <label for="precioVenta">Precio de venta:</label>
                        <input type="number" class="form-control" name="pprecioVenta" id="pprecioVenta" placeholder="P.venta">            
                    </div>
                </div>
                <div class="col-xs-12 col-sm-2 col-md-2 col-lg-2">
                    <div class="form-group">            
                       <label for="precioCompra">Precio de compra:</label>
                        <input type="number" class="form-control" name="pprecioCompra" id="pprecioCompra" placeholder="P.compra">            
                    </div>
                </div>
                <div class="col-xs-12 col-sm-2 col-md-2 col-lg-2">
                    <div class="form-group">            
                       <button type="button" id="bt_add" class="btn btn-primary">Agregar</button>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <table id="detalles" class="table table-striped table-bordered table-condensed table-hover">
                        <thead style="background-color: #A9D0F5">
                            <th>Opciones</th>
                            <th>Producto</th>
                            <th>Cantidad</th>
                            <th>Precio compra</th>
                            <th>Precio venta</th>
                            <th>Subtotal</th>
                        </thead>
                        <tfoot>
                            <th>TOTAL</th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th><h4 id="total1">S/. 0.00</h4></th>
                        </tfoot>
                        <tbody>
                            
                        </tbody>
                    </table>
                </div>
           </div>
           </div>
       </div>
       <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6" id="guardar">
          <div class="form-group">
              <input name="_token" value="{{csrf_token()}}" type="hidden"></input>
            <button class="btn btn-primary" type="submit">Guardar</button>
            <button class="btn btn-danger" type="reset">Cancelar</button>
            </div>  
        </div>
    </div>                
        {{Form::close()}}

@push('scripts')
<script type="text/javascript">

   $(document).ready(function(){
        
        $('#bt_add').click(function(){
            agregar(); //llama a la funcion agregar
        })
    });
    
    //variables
    var cont =0;
    total = 0;
    subtotal=[];
    $('#guardar').hide();
    
    
    function agregar(){
        id_articulo = $('#pidProd').val();
        articulo = $('#pidProd option:selected').text();
        cantidad = $('#pcantidad').val();
        precio_compra = $('#pprecioCompra').val();
        precio_venta = $('#pprecioVenta').val();
        
        
        
        if(id_articulo != "" && cantidad != "" && cantidad > 0 && precio_compra != ""&&precio_venta!="")
        {
            subtotal[cont] = (cantidad * precio_compra);
            total = total + subtotal[cont];
            
            var fila = '<tr class="selected" id="fila'+cont+'"><td><button class"btn btn-warning" type="button" onclick="eliminar('+cont+');">X</button></td><td><input type="hidden" name="idProd[]" value="'+id_articulo+'">'+articulo+'</td><td><input type="number" name="cantidad[]" value="'+cantidad+'"></td><td><input type="number" name="precioCompra[]" value="'+precio_compra+'"></td><td><input type="number" name="precioVenta[]" value="'+precio_venta+'"></td><td>'+subtotal[cont]+'</td></tr>';/*
            var fila = '<tr class="selected" id="fila'+cont+'"><td><button class"btn btn-warning" type="button" onclick="eliminar('+cont+');">X</button></td><td><input type="hidden" name="id_articulo[]" value="'+id_articulo+'">'+articulo+'</td><td><input type="number" name="cantidad[]" value="'+cantidad+'"></td><td><input type="number" name="precio_compra[]" value="'+precio_compra+'"></td><td>'+subtotal[cont]+'</td></tr>';*/
            
            
            //aumentar el contador
            cont++;
            
            //limpiar los controles
            limpiar();
                      
            //indicar el subtotal
            $('#total1').html('s/. '+total);
            
            //mostrar los botones de guardar y cancelar
            evaluar();
            
            //agregar la fila a la tabla
            $('#detalles').append(fila);
        }
        else
        {
            alert('Error al ingresar el detalle del ingreso, revise los datos del articulo');    
        }
        
    }
    
    
    function limpiar(){
        $('#pcantidad').val('');
        $('#pprecioCompra').val('');
        $('#pprecioVenta').val('');          
    }
    
    function evaluar(){
        if (total > 0)
        {
            $('#guardar').show();
        }
        else
        {
            $('#guardar').hide();
        }
    }
    
    function eliminar(index){
        total = total- subtotal[index];
        $('#total1').html('s/. '+total);
        $('#fila' + index).remove();
        evaluar();
    }

</script>
@endpush
@endsection