@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Editar Proveedor: {{ $proveedores->nombre}}</h3>
			@if (count($errors)>0)
			<div class="alert alert-danger">
				<ul>
				@foreach ($errors->all() as $error)
					<li>{{$error}}</li>
				@endforeach
				</ul>
			</div>
			@endif

			{!!Form::model($proveedores,['method'=>'PATCH','route'=>['proveedor.update',$proveedores->idProveedor]])!!}
			            {{Form::token()}}
			            <div class="form-group">
			            	<label for="nombre">Nombre</label>
			            	<input type="text" name="nombre" class="form-control" value="{{$proveedores->nombre}}" placeholder="Nombre...">
			            </div>
			            <div class="form-group">
			            	<label for="nombre">Limite De Credito</label>
			            	<input type="text" name="limiteCredito" class="form-control" value="{{$proveedores->limiteCredito}}" placeholder="money...">
			            </div>
			            <div class="form-group">
			            	<label for="debe">Debe</label>
			            	<input type="text" name="debe" class="form-control" value="{{$proveedores->debe}}" placeholder="Money...">
			            </div>
			            <div class="form-group">
			            	<label for="haber">Haber</label>
			            	<input type="text" name="haber" class="form-control" value="{{$proveedores->haber}}" placeholder="Money...">
			            </div>
			            <div class="form-group">
			            	<button class="btn btn-primary" type="submit">Guardar</button>
			            	<button class="btn btn-danger" type="reset">Cancelar</button>
			            </div>

			{!!Form::close()!!}		
            
		</div>
	</div>
@endsection