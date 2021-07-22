@extends ('layouts.admin')
@section ('contenido')
<!--tipobebidas-->
<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3>Listado de productos
		<td>
			@can('inventario.producto.create')
			<a href="producto/create"><button class="btn 	btn-success">Nuevo</button></a>
			@endcan
		</td>
		</h3>
		@include('inventario.producto.search')
	</div>
</div>

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover">
				<thead>
					<th>idProd</th>
					<th>descripcion</th>	
					<th>precio</th>
					<th>TipoBebida</th>
					<th>TipoEnvase</th>
					<th>Paquete</th>
					<th>Medida</th>
					<th>Marca</th>	
					<th>Sabor</th>			
					<th>estado</th>
					<!--quite tipo-->
					<th>Imagen</th>
					<th>Opciones</th>
				</thead>
				<!--variable recibida dese el controlador $tipobebidas-->
               			@foreach ($productos as $p)
				<tr>
					<td>{{ $p->idProd}}</td>
					<td>{{ $p->descripcion}}</td>
					<td>{{ $p->precio}}</td>
					<td>{{ $p->tipoBebida}}</td>
					<td>{{ $p->tipoEnvase}}</td>
					<td>{{ $p->paquete}}</td>
					<td>{{ $p->medida}}</td>
					<td>{{ $p->marca}}</td>
					<td>{{ $p->sabor}}</td>	
					<td>{{ $p->estado}}</td>
					<!--quite tipo-->
					<td>
						<img src="{{asset('imagenes/producto/'.$p->imagen)}}" alt="{{$p->descripcion}}" height="100px" width="100px" class="img-thumbnail">
					</td>	
					<!--quite <td>{{ $p->estado}}</td>-->		
					<td>
					@can('inventario.producto.edit')
						<a href="{{URL::action('ProductoController@edit',$p->idProd)}}"><button class="btn btn-info">Editar</button></a>
					@endcan
					@can('inventario.producto.destroy')
                         				<a href="" data-target="#modal-delete-{{$p->idProd}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
					@endcan
					</td>
				</tr>
				@include('inventario.producto.modal')
				@endforeach
			</table>
		</div>
		<!--mostrar la paginacion--> 
		{{$productos->render()}} <!--paso la  variable pasada del controlador-->
	</div>
</div>

@endsection