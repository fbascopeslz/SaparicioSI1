@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-12 col-md-6 col-sm-12 col-xs-12">
			<h3>Editar Producto: <b href="">{{ $productos->producto}}</b></h3>
			@if (count($errors)>0)
			<div class="alert alert-danger">
				<ul>
				@foreach ($errors->all() as $error)
					<li>{{$error}}</li>
				@endforeach
				</ul>
			</div>
			@endif

	{!!Form::model($productos,['method'=>'PATCH','route'=>['inventario.update',$productos->idProd],'files'=>'true'])!!}
            {{Form::token()}}
            <div class="row">
                <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                    <div class="fomr-group">
                         <label for="precio">Stock</label><!---->
                        <input type="number" name="stock" required value="{{$inventario->stock}}" class="form-control" placeholder="stock...">
                    </div>   
                </div><div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                    <div class="fomr-group">
                         <label for="precio">Stock Min</label><!---->
                        <input type="number" name="minStock" required value="{{$inventario->minStock}}" class="form-control" placeholder="Stock min...">
                    </div>   
                </div>
                <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                    <div class="fomr-group">
                         <label for="precio">Stock Max</label><!---->
                        <input type="number" name="maxStock"  required value="{{$inventario->maxStock}}" class="form-control" placeholder="maxStock...">
                    </div>   
                </div>
                
                <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                    <div class="form-group"><!--TODO SE SACA DEL REQUEST-->
                        <label>Almacen</label>
                        <select name="idAlmacen" class="form-control"><!--Name pertenece al request-->
                            @foreach($almacen as $al)<!--tipobebidas pertenece al Controllador-->
                                   	<option required value="{{$al->idAlmacen}}" >{{$al->descripcion}}</option>
                            @endforeach
                        </select>
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