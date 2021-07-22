@extends ('layouts.admin')
@section ('contenido')
<!--tipobebidas-->
<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3>Listado de paquete
		<td>
			@can('inventario.paquete.create')
			<a href="paquete/create"><button class="btn 	btn-success">Nuevo</button></a>
			@endcan
		</td>
		</h3>
		@include('inventario.paquete.search')
	</div>
</div>

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover">
				<thead>
					<th>Id</th>
					<th>Descripcion</th>
					<th>Cantidad</th>
					<th>Opciones</th>
				</thead>
				<!--variable recibida dese el controlador $tipobebidas-->
               			@foreach ($paquetes as $p)
				<tr>
					<td>{{ $p->idPaquete}}</td>
					<td>{{ $p->descripcion}}</td>
					<td>{{ $p->cantidad}}</td>		
					<td>
					@can('inventario.paquete.edit')
						<a href="{{URL::action('PaqueteController@edit',$p->idPaquete)}}"><button class="btn btn-info">Editar</button></a>
					@endcan
					@can('inventario.paquete.destroy')		
                         				<a href="" data-target="#modal-delete-{{$p->idPaquete}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
                         				@endcan
					</td>
				</tr>
				@include('inventario.paquete.modal')
				@endforeach
			</table>
		</div>
		<!--mostrar la paginacion--> 
		{{$paquetes->render()}} <!--paso la  variable pasada del controlador-->
	</div>
</div>

@endsection