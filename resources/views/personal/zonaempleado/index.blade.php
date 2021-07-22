@extends ('layouts.admin')
@section ('contenido')
<!--sabores-->
<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3>Listado de Zona Empleado
		<td>
			@can('personal.zonaempleado.create')
			<a href="zonaempleado/create"><button class="btn 	btn-success">Nuevo</button></a>	
			@endcan
		</td>
		</h3>
		@include('personal.zonaempleado.search')
	</div>
</div>

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover">
				<thead>
					<th>CI</th>
					<th>Nombre</th>
					<th>Cargo</th>
					<th>Zona</th>
					<th>Opciones</th>
				</thead>
				<!--variable recibida dese el controlador $sabores-->
               			@foreach ($zonaem as $ze)
				<tr>
					<td>{{ $ze->ci}}</td>
					<td>{{ $ze->nombre}}</td>
					<td>{{ $ze->cargo}}</td>
					<td>{{ $ze->zona}}</td>				
					<td>
					@can('personal.cargo.edit')
						<a href="{{URL::action('ZonaEmpleadoController@edit',$ze->ci)}}"><button class="btn btn-info">Editar</button></a>
					@endcan
					@can('personal.cargo.destroy')
                         				<a href="" data-target="#modal-delete-{{$ze->ci}}" data-toggle="modal">
                         					<button class="btn btn-danger">Eliminar</button>
                         				</a>
                         				@endcan
					</td>
				</tr>
				@include('personal.zonaempleado.modal')
				@endforeach
			</table>
		</div>
		<!--mostrar la paginacion--> 
		{{$zonaem->render()}} <!--paso la  variable pasada del controlador-->
	</div>
</div>

@endsection