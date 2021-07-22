@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Editar Producto: {{ $productos->descripcion}}</h3>
			@if (count($errors)>0)
			<div class="alert alert-danger">
				<ul>
				@foreach ($errors->all() as $error)
					<li>{{$error}}</li>
				@endforeach
				</ul>
			</div>
			@endif

	{!!Form::model($productos,['method'=>'PATCH','route'=>['producto.update',$productos->idProd],'files'=>'true'])!!}
            {{Form::token()}}
            <div class="row">
                <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                    <div class="fomr-group">
                         <label for="descripcion">Descripcion</label><!---->
                        <input type="text" name="descripcion" required value="{{$productos->descripcion}}" class="form-control" placeholder="descripcion...">
                    </div>                 
                </div>
                <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                    <div class="fomr-group">
                         <label for="precio">Precio</label><!---->
                        <input type="text" name="precio"  value="{{$productos->precio}}" class="form-control" placeholder="precio...">
                    </div>   
                </div>
                <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                    <div class="form-group"><!--TODO SE SACA DEL REQUEST-->
                        <label>Tipo de Bebida</label>
                        <select name="idtipoBebida" class="form-control"><!--Name pertenece al request-->
                            @foreach($tipobebidas as $tib)<!--tipobebidas pertenece al Controllador-->
                            	       @if($tib->idTipoBebida==$productos->idTipoBebida)
                                	<option value="{{$tib->idTipoBebida}}" selected>{{$tib->tipo}}</option>
                                   @else
                                   	<option value="{{$tib->idTipoBebida}}" >{{$tib->tipo}}</option>
                                   @endif
                            @endforeach
                        </select>
                    </div>           
                </div>

                <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                    <div class="form-group"><!--TODO SE SACA DEL REQUEST-->
                        <label>Tipo de Envase</label>
                        <select name="idtipoEnvase" class="form-control">
                            @foreach($tipoenvases as $tie)
                            	@if($tie->idTipoEnvase==$productos->idTipoEnvase)
                                <option value="{{$tie->idTipoEnvase}}" selected>{{$tie->tipo}}</option>
                                @else
                                <option value="{{$tie->idTipoEnvase}}">{{$tie->tipo}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>           
                </div>
               
                <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                    <div class="form-group"><!--TODO SE SACA DEL REQUEST-->
                        <label>Paquete</label>
                        <select name="idpaquete" class="form-control">
                            @foreach($paquetes as $pa)
                            @if($pa->idPaquete==$productos->idPaquete)
                                <option value="{{$pa->idPaquete}}" selected>{{$pa->cantidad}}</option>
                                @else
                                <option value="{{$pa->idPaquete}}">{{$pa->cantidad}}  </option>
                            	@endif
                            @endforeach
                        </select>
                    </div>           
                </div>

                <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                    <div class="form-group"><!--TODO SE SACA DEL REQUEST-->
                        <label>Medida</label>
                        <select name="idmedida" class="form-control">
                            @foreach($medidas as $me)
                             @if($me->idMedida==$productos->idMedida)
                                <option value="{{$me->idMedida}}" selected>{{$me->medida}}</option>
                                @else
                                <option velue="{{$me->idMedida}}">{{$me->medida}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>           
                </div>

                <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                    <div class="form-group"><!--TODO SE SACA DEL REQUEST-->
                        <label>Marca</label>
                        <select name="idmarca" class="form-control">
                            @foreach($marcas as $ma)
                             @if($ma->idMarca==$productos->idMarca)
                                <option value="{{$ma->idMarca}}" selected >{{$ma->nombre}}</option>
                            @else
                                <option value="{{$ma->idMarca}}"  >{{$ma->nombre}}</option>
                            @endif
                            @endforeach
                        </select>
                    </div>           
                </div>

               <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                    <div class="form-group"><!--TODO SE SACA DEL REQUEST-->
                        <label>Sabor</label>
                        <select name="idsabor" class="form-control">
                            @foreach($sabores as $sa)
                            @if($sa->idSabor==$productos->idSabor)
                                <option value="{{$sa->idSabor}}" selected>{{$sa->nombre}}</option>
                            @else
                            <option value="{{$sa->idSabor}}">{{$sa->nombre}}</option>
                            @endif
                            @endforeach
                        </select>
                    </div>           
                </div>       


               <!-- <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                    <div class="fomr-group">
                         <label for="estado">Estado</label>                     
                        <select>
	                        <option value="estado">Activo</option>
	                        <option value="estado">Inctivo</option> 	
                        </select>
                       </div>                 
                </div>
-->
               
                <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                    <div class="fomr-group">
                         <label for="imagen">Imagen</label><!---->
                        <input type="file" name="imagen" class="form-control">
                        @if (($productos->imagen)!="")
                        	<img src="{{asset('imagenes/producto/'.$productos->imagen)}}" height="300px" width="300px">
                        @endif

                    </div>   
                </div>

                
                <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                    <div class="form-group">
                        <button class="btn btn-primary" type="submit">Guardar</button>
                        <button class="btn btn-danger" type="reset">Cancelar</button>
                    </div>
            </div>
                <!--Tambien es usado por TBController en el metodo store-->
        </div>
            

			{!!Form::close()!!}		
         
@endsection