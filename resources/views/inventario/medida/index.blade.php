@extends ('layouts.admin')
@section ('contenido')
<!--tipobebidas-->
<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3>Listado de medidas
			<div>
			@can('inventario.medida.create')
				<a href="medida/create"><button class="btn 	btn-success">Nuevo</button></a>
			@endcan
			</div>
		</h3>
		@include('inventario.medida.search')
	</div>
</div>

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover">
				<thead>
					<th>Id</th>
					<th>Medida</th>
					<th>Opciones</th>
				</thead>
				<!--variable recibida dese el controlador $tipobebidas-->
               			@foreach ($medidas as $m)
				<tr>
					<td>{{ $m->idMedida}}</td>
					<td>{{ $m->medida}}</td>				
					<td>
					@can('inventario.medida.edit')
						<a href="{{URL::action('MedidaController@edit',$m->idMedida)}}"><button class="btn btn-info">Editar</button></a>
					@endcan
					@can('inventario.medida.destroy')
	                         				<a href="" data-target="#modal-delete-{{$m->idMedida}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
	                         			@endcan
					</td>
				</tr>
				@include('inventario.medida.modal')
				@endforeach
			</table>
		</div>
		<!--mostrar la paginacion--> 
		{{$medidas->render()}} <!--paso la  variable pasada del controlador-->
	</div>
</div>

@endsection