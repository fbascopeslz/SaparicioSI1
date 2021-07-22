@extends ('layouts.admin')
@section ('contenido')
<!--tipobebidas-->
<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3>Listado de Almacen
			<div>
			@can('almacen.almacen.create')
				<a href="almacen/create"><button class="btn 	btn-success">Nuevo</button></a>
			@endcan
			</div>
		</h3>
		@include('inventario.almacen.search')
	</div>
</div>

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover">
				<thead>
					<th>Id</th>
					<th>Ubicacion</th>
					<th>Descripcion</th>
					<th>Opciones</th>
				</thead>
				<!--variable recibida dese el controlador $tipobebidas-->
               			@foreach ($almacen as $m)
				<tr>
					<td>{{ $m->idAlmacen}}</td>
					<td>{{ $m->ubicacion}}</td>
					<td>{{ $m->descripcion}}</td>				
					<td>
					@can('inventario.almacen.edit')
						<a href="{{URL::action('AlmacenController@edit',$m->idAlmacen)}}"><button class="btn btn-info">Editar</button></a>
					@endcan
					@can('inventario.medida.destroy')
	                         				<a href="" data-target="#modal-delete-{{$m->idAlmacen}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
	                         			@endcan
					</td>
				</tr>
				@include('inventario.almacen.modal')
				@endforeach
			</table>
		</div>
		<!--mostrar la paginacion--> 
		{{$almacen->render()}} <!--paso la  variable pasada del controlador-->
	</div>
</div>

@endsection