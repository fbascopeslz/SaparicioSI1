@extends ('layouts.admin')
@section ('contenido')
    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <h3>Nuevo producto</h3>
            @if (count($errors)>0)
            <div class="alert alert-danger">
                <ul>
                <!--errors lo RECIVIMOS DEL ARCHIVO REQUEST-->
                @foreach ($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
                </ul>
            </div>
            @endif
        </div>
    </div>
            <!--enviar parametros -->
            <!--URL envia desde web, con post llama a store TipoBebida controller-->
            {!!Form::open(array('url'=>'inventario/producto','method'=>'POST','autocomplete'=>'off','files'=>'true'))!!}
            {{Form::token()}} <!---->
            <div class="row">
                <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                    <div class="fomr-group">
                         <label for="descripcion">Descripcion</label><!---->
                        <input type="text" name="descripcion" required value="{{old('descripcion')}}" class="form-control" placeholder="descripcion...">
                    </div>                 
                </div>
                <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                    <div class="fomr-group">
                         <label for="precio">Precio</label><!---->
                        <input type="text" name="precio"  value="{{old('precio')}}" class="form-control" placeholder="precio...">
                    </div>   
                </div>
                <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                    <div class="form-group"><!--TODO SE SACA DEL REQUEST-->
                        <label>Tipo de Bebida</label>
                        <select name="idtipoBebida" class="form-control"><!--Name pertenece al request-->
                            @foreach($tipobebidas as $tib)<!--tipobebidas pertenece al Controllador-->
                                <option value="{{$tib->idTipoBebida}}">{{$tib->tipo}}</option>
                            @endforeach
                        </select>
                    </div>           
                </div>

                <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                    <div class="form-group"><!--TODO SE SACA DEL REQUEST-->
                        <label>Tipo de Envase</label>
                        <select name="idtipoEnvase" class="form-control">
                            @foreach($tipoenvases as $tie)
                                <option value="{{$tie->idTipoEnvase}}">{{$tie->tipo}}</option>
                            @endforeach
                        </select>
                    </div>           
                </div>
               
                <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                    <div class="form-group"><!--TODO SE SACA DEL REQUEST-->
                        <label>Paquete</label>
                        <select name="idpaquete" class="form-control">
                            @foreach($paquetes as $pa)
                                <option value="{{$pa->idPaquete}}">{{$pa->cantidad}}</option>

                            @endforeach
                        </select>
                    </div>           
                </div>

                <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                    <div class="form-group"><!--TODO SE SACA DEL REQUEST-->
                        <label>Medida</label>
                        <select name="idmedida" class="form-control">
                            @foreach($medidas as $me)
                                <option value="{{$me->idMedida}}">{{$me->medida}}</option>
                            @endforeach
                        </select>
                    </div>           
                </div>

                <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                    <div class="form-group"><!--TODO SE SACA DEL REQUEST-->
                        <label>Marca</label>
                        <select name="idmarca" class="form-control">
                            @foreach($marcas as $ma)
                                <option value="{{$ma->idMarca}}">{{$ma->nombre}}</option>
                            @endforeach
                        </select>
                    </div>           
                </div>

               <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                    <div class="form-group"><!--TODO SE SACA DEL REQUEST-->
                        <label>Sabor</label>
                        <select name="idsabor" class="form-control">
                            @foreach($sabores as $sa)
                                <option value="{{$sa->idSabor}}">{{$sa->nombre}}</option>
                            @endforeach
                        </select>
                    </div>           
                </div>



                
                <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                    <div class="fomr-group">
                         <label for="imagen">Imagen</label><!---->
                        <input type="file" name="imagen" class="form-control">
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