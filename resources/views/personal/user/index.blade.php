@extends ('layouts.admin')
@section ('contenido')
<!--tipobebidas-->
<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3>Listado de personal
		<td>
			@can('personal.user.create')
			<a href="user/create"><button class="btn 	btn-success">Nuevo</button></a>	
			@endcan
		</td>
		</h3>
		@include('personal.user.search')
	</div>
</div>

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover">
				<thead>
					<th>Cod</th>
					<th>Nombre</th>
					<th>cargo</th>
					<th>telefono</th>
					<th>email</th>
					<th>Opciones</th>
				</thead>
				<!--variable recibida dese el controlador $marcas-->
               			@foreach ($users as $m)
				<tr>
					<td>{{ $m->codigo}}</td>
					<td>{{ $m->nombre}} {{ $m->paterno}}</td>
					<td>{{$m->cargo}}</td>
					<td>{{$m->telefono}}</td>	
					<td>{{$m->email}}</td>			
					<td>
					@can('personal.user.edit')
						<a href="{{URL::action('UserController@edit',$m->ci)}}" ><button class="btn btn-info">Editar</button></a>
					@endcan
					@can('personal.user.destroy')
                         				<a href="" data-target="#modal-delete-{{$m->ci}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
					@endcan
					</td>
				</tr>
				@include('personal.user.modal')
				@endforeach
			</table>
		</div>
		<!--mostrar la paginacion--> 
		{{$users->render()}} <!--paso la  variable pasada del controlador-->
	</div>
</div>

@endsection