@extends ('layouts.admin')
@section ('contenido')
<!--sabores-->
<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3>Listado de cargos
		<td>
			@can('personal.cargo.create')
			<a href="cargo/create"><button class="btn 	btn-success">Nuevo</button></a>	
			@endcan
		</td>
		</h3>
		@include('personal.cargo.search')
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
               			@foreach ($cargos as $ca)
				<tr>
					<td>{{ $ca->idCargo}}</td>
					<td>{{ $ca->cargo}}</td>				
					<td>
					@can('personal.cargo.edit')
						<a href="{{URL::action('CargoController@edit',$ca->idCargo)}}"><button class="btn btn-info">Editar</button></a>
					@endcan
					@can('personal.cargo.destroy')
                         				<a href="" data-target="#modal-delete-{{$ca->idCargo}}" data-toggle="modal">
                         					<button class="btn btn-danger">Eliminar</button>
                         				</a>
                         				@endcan
					</td>
				</tr>
				@include('personal.cargo.modal')
				@endforeach
			</table>
		</div>
		<!--mostrar la paginacion--> 
		{{$cargos->render()}} <!--paso la  variable pasada del controlador-->
	</div>
</div>

@endsection