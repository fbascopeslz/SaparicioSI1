@extends ('layouts.admin')
@section ('contenido')
<!--tipobebidas-->
<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3>Listado de tipo Marcas
			<td>
			@can('inventario.marca.create')
				<a href="marca/create"><button class="btn 	btn-success">Nuevo</button></a>	
			@endcan
			</td>
		</h3>
		@include('inventario.marca.search')
	</div>
</div>

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover">
				<thead>
					<th>Id</th>
					<th>Nombre</th>
					<th>Opciones</th>
				</thead>
				<!--variable recibida dese el controlador $marcas-->
               			@foreach ($marcas as $m)
				<tr>
					<td>{{ $m->idMarca}}</td>
					<td>{{ $m->nombre}}</td>				
					<td>
					@can('inventario.marca.edit')
						<a href="{{URL::action('MarcaController@edit',$m->idMarca)}}"><button class="btn btn-info">Editar</button></a>
					@endcan
					@can('inventario.marca.destroy')
                         				<a href="" data-target="#modal-delete-{{$m->idMarca}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
                         				@endcan
					</td>
				</tr>
				@include('inventario.marca.modal')
				@endforeach
			</table>
		</div>
		<!--mostrar la paginacion--> 
		{{$marcas->render()}} <!--paso la  variable pasada del controlador-->
	</div>
</div>

@endsection