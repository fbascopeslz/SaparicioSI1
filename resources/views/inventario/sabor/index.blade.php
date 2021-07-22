@extends ('layouts.admin')
@section ('contenido')
<!--sabores-->
<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3>Listado de sabores
		<td>
			@can('inventario.sabor.create')
			<a href="sabor/create"><button class="btn 	btn-success">Nuevo</button></a>
			@endcan
		</td>
		</h3>
		@include('inventario.sabor.search')
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
				<!--variable recibida dese el controlador $sabores-->
               			@foreach ($sabores as $s)
				<tr>
					<td>{{ $s->idSabor}}</td>
					<td>{{ $s->nombre}}</td>				
					<td>
					@can('inventario.producto.edit')
						<a href="{{URL::action('SaborController@edit',$s->idSabor)}}"><button class="btn btn-info">Editar</button></a>
					@endcan
					@can('inventario.producto.destroy')
                         				<a href="" data-target="#modal-delete-{{$s->idSabor}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
                         				@endcan
					</td>
				</tr>
				@include('inventario.sabor.modal')
				@endforeach
			</table>
		</div>
		<!--mostrar la paginacion--> 
		{{$sabores->render()}} <!--paso la  variable pasada del controlador-->
	</div>
</div>

@endsection