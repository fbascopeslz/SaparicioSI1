@extends ('layouts.admin')
@section ('contenido')
<div class="row">
    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
        <h3>Nuevo Cliente</h3>
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
        {{Form::open(array('url' => 'ventas/cliente', 'method' => 'POST', 'autocomplete' => 'off'))}}
        {{Form::token()}}
    <div class="row">  
        <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
            <div class="form-group">            
               <label for="ci">CI:</label>
                <input type="number" class="form-control" name="ci" id="pci" placeholder="Cedula de indentidad."  value="{{old('ci')}}">            
            </div>
        </div>
        <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
            <div class="form-group">            
               <label for="nombre">Nombre:</label>
                <input type="text" class="form-control" name="nombre" id="pnombre" placeholder="Nombres..."  value="{{old('nombre')}}">            
            </div>
        </div>
        <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
            <div class="form-group">            
               <label for="paterno">Apellido Paterno :</label>
                <input type="text" class="form-control" name="paterno" id="ppaterno" placeholder="Apellido Paterno..."  required value="{{old('paterno')}}">            
            </div>
        </div>
        <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
            <div class="form-group">            
               <label for="materno">Apellido Materno:</label>
                <input type="text" class="form-control" name="materno" id="pmaterno" placeholder="Nombres..."  value="{{old('materno')}}">            
            </div>
        </div>
        <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
             <div class="form-group">            
               <label for="sexo">Sexo:</label>
               <select name="sexo" id="" class="form-control">                  
                   <option value="M">Masculino</option> 
                   <option value="F">Femenino</option> 
                   <option value="O">Otros</option>
               </select>
            </div>
        </div>
        <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
             <div class="form-group">            
               <label for="tipo">Tipo Cliente:</label>
               <select name="tipo" id="" class="form-control">                  
                   <option value="Vip">Vip</option> 
                   <option value="Medio">Medio</option> 
                   <option value="Standar">Standar</option>
               </select>
            </div>
        </div>

        <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
            <div class="form-group">            
               <label for="telefono">Telefono:</label>
                <input type="text" class="form-control" name="telefono" id="" placeholder="telefono "  value="{{old('telefono')}}">            
            </div>
        </div>
</div>
    <div class="row">
       
       <div class="panel panel-primary">
           <div class="panel-body">
              <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                    <div class="form-group">
                        <label for="">Zonas</label><!--pidProd-->
                        <select class="form-control selectpicker" name="pidZona" id="pidZona" data-Live-search="true">
                            @foreach($zonas as $zona)
                                <option value="{{$zona -> idZona}}">{{$zona -> nombre}}</option>
                            @endforeach
                        </select>
                    </div>
               </div>
               <div class="col-xs-12 col-sm-2 col-md-2 col-lg-2">
                    <div class="form-group">            
                       <label for="direccion">Direccion</label>
                        <input type="text" class="form-control" name="pdireccion" id='pdireccion' placeholder="direccion">            
                    </div>
                </div>
                <div class="col-xs-12 col-sm-2 col-md-2 col-lg-2">
                    <div class="form-group">            
                       <label for="obs">Observaciones</label>
                        <input type="text" class="form-control" name="pobs" id='pobs' placeholder="Detalle de direc...">            
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
                            <th>Zona</th>
                            <th>Direccion</th>
                            <th>Observacion</th>
                            
                        </thead>
                        <tfoot>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th><h4 ></h4></th>
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
        idZona = $('#pidZona').val();
        zona = $('#pidZona option:selected').text();
      //  id_cantidad= $('#pidDir').val();
        direccion = $('#pdireccion').val();
        obs =$('#pobs').val();
        /*
        precio_compra = $('#pprecioCompra').val();
        precio_venta = $('#pprecioVenta').val();
        */
        
        
        if(idZona != "" && zona != ""&& direccion != ""&& obs!= "")
        {
           // subtotal[cont] = (cantidad * precio_compra);
            //total = total + subtotal[cont];
            
            var fila = '<tr class="selected" id="fila'+cont+'"><td><button type="button" class="btn btn-warning"  onclick="eliminar('+cont+');">X</button></td><td><input type="hidden" name="idZona[]" value="'+idZona+'">'+zona+'</td><td><input type="text" name="direccion[]" value="'+direccion+'"></td><td><input type="text" name="obs[]" value="'+obs+'"></td></tr>';/*
            var fila = '<tr class="selected" id="fila'+cont+'"><td><button class"btn btn-warning" type="button" onclick="eliminar('+cont+');">X</button></td><td><input type="hidden" name="id_articulo[]" value="'+id_articulo+'">'+articulo+'</td><td><input type="number" name="cantidad[]" value="'+cantidad+'"></td><td><input type="number" name="precio_compra[]" value="'+precio_compra+'"></td><td>'+subtotal[cont]+'</td></tr>';*/
            
            
            //aumentar el contador
            cont++;
            
            //limpiar los controles
            limpiar();
                      
            //indicar el subtotal
          //  $('#total1').html('s/. '+total);
            
            //mostrar los botones de guardar y cancelar
            evaluar();
            
            //agregar la fila a la tabla
            $('#detalles').append(fila);
        }
        else
        {
            alert('Error al ingresar el detalle del ingreso, revise los datos ');    
        }
        
    }
    
    
    function limpiar(){
        $('#pdireccion').val('');
        $('#pobs').val('');
       // $('#pprecioCompra').val('');
       // $('#pprecioVenta').val('');          
    }
    
    function evaluar(){
        if (cont > 0)
        {
            $('#guardar').show();
        }
        else
        {
            $('#guardar').hide();
        }
    }
    
    function eliminar(index){
        //total = total- subtotal[index];
       // $('#total1').html('s/. '+total);
        $('#fila' + index).remove();
        evaluar();
    }

</script>
@endpush
@endsection