@extends ('layouts.admin')
@section ('contenido')
<!--tipobebidas-->
<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3>Listado de Proveedores
			<td>
				@can('compras.proveedor.create')
				<a href="proveedor/create"><button class="btn 	btn-success">Nuevo</button></a>
				@endcan
			</td>
		</h3>
		<!-- en esta seccion se mostrar la barra de navegacion-->
		@include('compras.proveedor.search')
	</div>
</div>

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover">
				<thead>
					<th>Nombre</th>
					<th>LimiteCredito</th>
					<th>Haber</th>
					<th>Debe</th>
					<th>Opciones</th>
				</thead>
				<!--variable recibida dese el controlador $marcas-->
               			@foreach ($proveedores as $pv)
				<tr>
					<td>{{ $pv->nombre}}</td>
					<td>{{ $pv->limiteCredito}}</td>				
					<td>{{$pv->haber}}</td>
					<td>{{$pv->debe}}</td>
					<td>
					@can('compras.proveedores.edit')
						<a href="{{URL::action('ProveedorController@edit',$pv->idProveedor)}}"><button class="btn btn-info">Editar</button></a>
					@endcan
					@can('compras.proveedores.destroy')
                         				<a href="" data-target="#modal-delete-{{$pv->idProveedor}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
					@endcan
					</td>
				</tr>
				@include('compras.proveedor.modal')
				@endforeach
			</table>
		</div>
		<!--mostrar la paginacion--> 
		{{$proveedores->render()}} <!--paso la  variable pasada del controlador-->
	</div>
</div>

@endsection