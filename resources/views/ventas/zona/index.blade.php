@extends ('layouts.admin')
@section ('contenido')
<!--sabores-->
<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3>Listado de zonas
		<td>
			@can('ventas.zona.create')
			<a href="zona/create"><button class="btn 	btn-success">Nuevo</button></a>
			@endcan
		</td>
		</h3>
		@include('ventas.zona.search')
	</div>
</div>

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover">
				<thead>
					<th>codigo</th>
					<th>Zona</th>
					<th>Opciones</th>
				</thead>
				<!--variable recibida dese el controlador $sabores-->
               			@foreach ($zonas as $ca)
				<tr>
					<td>{{ $ca->idZona}}</td>
					<td>{{ $ca->nombre}}</td>				
					<td>
					@can('ventas.zona.edit')
						<a href="{{URL::action('ZonaController@edit',$ca->idZona)}}"><button class="btn btn-info">Editar</button></a>
					@endcan
					@can('ventas.zona.edit')
                         				<a href="" data-target="#modal-delete-{{$ca->idZona}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
                         				@endcan
					</td>
				</tr>
				@include('ventas.zona.modal')
				@endforeach
			</table>
		</div>
		<!--mostrar la paginacion--> 
		{{$zonas->render()}} <!--paso la  variable pasada del controlador-->
	</div>
</div>

@endsection