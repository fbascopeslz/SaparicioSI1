@extends ('layouts.admin')
@section ('contenido')
<!--tipobebidas-->
<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3>Listado de tipo de envase
		<td>
			@can('inventario.tipoenvase.create')
			<a href="tipoenvase/create"><button class="btn 	btn-success">Nuevo</button></a>
			@endcan
		</td>
		</h3>
		@include('inventario.tipoenvase.search')
	</div>
</div>

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover">
				<thead>
					<th>Id</th>
					<th>Tipo</th>
					<th>Opciones</th>
				</thead>
				<!--variable recibida dese el controlador $tipobebidas-->
               			@foreach ($tipoenvases as $tie)
				<tr>
					<td>{{ $tie->idTipoEnvase}}</td>
					<td>{{ $tie->tipo}}</td>				
					<td>
					@can('inventario.tipoenvase.edit')
						<a href="{{URL::action('TipoEnvaseController@edit',$tie->idTipoEnvase)}}"><button class="btn btn-info">Editar</button></a>
					@endcan
					@can('inventario.tipoenvase.destroy')
                         				<a href="" data-target="#modal-delete-{{$tie->idTipoEnvase}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
                         				@endcan
					</td>
				</tr>
				@include('inventario.tipoenvase.modal')
				@endforeach
			</table>
		</div>
		<!--mostrar la paginacion--> 
		{{$tipoenvases->render()}} <!--paso la  variable pasada del controlador-->
	</div>
</div>

@endsection