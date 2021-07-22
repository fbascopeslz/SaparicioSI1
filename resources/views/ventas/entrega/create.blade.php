@extends ('layouts.admin')
@section ('contenido')
<div class="row">
    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
        <h3>Nuevo Pedido</h3>
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
        {{Form::open(array('url' => 'ventas/entrega', 'method' => 'POST', 'autocomplete' => 'off'))}}
        {{Form::token()}}
    <div class="row">
        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-12">
             <div class="form-group">            
               <label for="proveedor">Cliente:</label>
               <select name="cicliente" id="ci" class="form-control selectpicker" data-Live-search="true">
                   @foreach($cliente as $pv)
                       <option value="{{$pv-> ci}}">{{$pv -> nombrec}} </option>
                   @endforeach
               </select>
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
                                <option value="{{$producto -> idProd}}_{{$producto ->precio}}">{{$producto -> producto}}</option>
                            @endforeach
                        </select>
                    </div>
               </div>
                
                <div class="col-xs-12 col-sm-2 col-md-2 col-lg-2">
                    <div class="form-group">            
                       <label for="cantidad">Precio :</label>
                        <input type="number" class="form-control" name="pprecio_venta" id="pprecio_venta" readonly>            
                    </div>
                </div>
                <div class="col-xs-12 col-sm-2 col-md-2 col-lg-2">
                    <div class="form-group">            
                       <label for="cantidad">Descuento:</label>
                        <input type="number" class="form-control" name="pdescuento" id="pdescuento" placeholder="Descuento...">            
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
                       <button type="button" id="bt_add" class="btn btn-primary">Agregar</button>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <table id="detalles" class="table table-striped table-bordered table-condensed table-hover">
                        <thead style="background-color: #A9D0F5">
                            <th>Opciones</th>
                            <th>Producto</th>
                            <th>Cantidad</th>
                            <th>Precio</th>
                            <th>Descuento</th>
                            <th>Subtotal</th>
                        </thead>
                        <tfoot>
                            <th>TOTAL</th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th><h4 id="total">S/. 0.00</h4> <input type="text" name="total_venta" id="total_venta"></th>
                        </tfoot>
                        <tbody>
                            
                        </tbody>
                    </table>
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
<script>
    $(document).ready(function(){
         
        $('#bt_add').click(function(){
            agregar();
           
        })
        mostrarValores();
        
    });
    
    //variables
    var cont =0;
    total = 0;
    subtotal=[];
    $('#guardar').hide();
    
    //cada vez que se cambie el articulo se ejecuta
    $('#pidProd').change(mostrarValores);
    
    function mostrarValores(){
        datosArticulo = document.getElementById('pidProd').value.split('_');
        $('#pprecio_venta').val(datosArticulo[1]);
        //$('#pstock').val(datosArticulo[2]);
    }
    
    function agregar(){
        
        datosArticulo = document.getElementById('pidProd').value.split('_');
        
        id_articulo = datosArticulo[0];
        articulo = $('#pidProd option:selected').text();
        cantidad = $('#pcantidad').val();
        precio_venta = $('#pprecio_venta').val();
        descuento = $('#pdescuento').val();
//        stock = $('#pstock').val();
        
        
        if(id_articulo != "" && cantidad != "" && cantidad > 0 && precio_venta != "" && descuento != "" )
        {
            
            /*if(stock >= cantidad)
            {*/
            subtotal[cont] = (cantidad * precio_venta - descuento);
            total = total + subtotal[cont];
            
            var fila = '<tr class="selected" id="fila'+cont+'"><td><button class"btn btn-danger" type"button" onclick="eliminar('+cont+');">X</button></td><td><input type="hidden" name="idProd[]" value="'+id_articulo+'">'+articulo+'</td><td><input type="number" name="cantidad[]" value="'+cantidad+'"></td><td><input type="number" name="precio[]" value="'+precio_venta+'" readonly></td><td><input type="number" name="descuento[]" value="'+descuento+'"></td><td>'+subtotal[cont]+'</td></tr>';
            
            //aumentar el contador
            cont++;
            
            //limpiar los controles
            limpiar();
                                 
            //indicar el subtotal
            $('#total').html('s/. '+total);
            $('#total_venta').val(total);
            //mostrar los botones de guardar y cancelar
            evaluar();
            
            //agregar la fila a la tabla
            $('#detalles').append(fila);
                
             cantidad=0;
            stock=0;
            precio_venta=0;
                
       /*     }
            else
            {
                alert('La cantidad a vender supera el stock de: ' + stock );
            }*/
        }
        else
        {
            alert('Error al ingresar la venta, revise los datos del articulo');    
        }
        
    }
    
    
    function limpiar(){
        $('#pcantidad').val('');
        $('#pprecio_venta').val('');
        $('#pdescuento').val('');
        
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
        $('#total').html('s/. '+total);
        $('#total_venta').val(total);
        $('#fila' + index).remove();
        evaluar();
    }
</script>
@endpush
@endsection