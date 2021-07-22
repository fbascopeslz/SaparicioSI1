@extends ('layouts.admin')
@section ('contenido')
    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <h3>Nuevo Registro de Invetario</h3>
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
            {!!Form::open(array('url'=>'inventario','method'=>'POST','autocomplete'=>'off','files'=>'true'))!!}
            {{Form::token()}} <!---->
            <div class="row">
                 <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                    <div class="form-group"><!--TODO SE SACA DEL REQUEST-->
                        <label>Producto</label>
                        <select name="idProd" class="form-control"><!--Name pertenece al request-->
                            @foreach($productos as $pr)<!--tipobebidas pertenece al Controllador-->
                                <option value="{{$pr->idProd}}">{{$pr->producto}}</option>
                            @endforeach
                        </select>
                    </div>           
                </div>
                <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                    <div class="form-group"><!--TODO SE SACA DEL REQUEST-->
                        <label>Almacen</label>
                        <select name="idAlmacen" class="form-control"><!--Name pertenece al request-->
                            @foreach($almacen as $al)<!--tipobebidas pertenece al Controllador-->
                                <option value="{{$al->idAlmacen}}">{{$al->idAlmacen}} {{$al->descripcion}}</option>
                            @endforeach
                        </select>
                    </div>           
                </div>
                
                <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                    <div class="fomr-group">
                         <label for="Stock">Stock</label><!---->
                        <input type="number" name="stock"  value="{{old('stock')}}" class="form-control" placeholder="stock...">
                    </div>   
                </div>
                <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                    <div class="fomr-group">
                         <label for="Stock">Stock Minimo</label><!---->
                        <input type="number" name="minStock"  value="{{old('minStock')}}" class="form-control" placeholder="minStock...">
                    </div>   
                </div>
                <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                    <div class="fomr-group">
                         <label for="Stock">Stock Maximo</label><!---->
                        <input type="number" name="maxStock"  value="{{old('maxStock')}}" class="form-control" placeholder="maximo stock...">
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