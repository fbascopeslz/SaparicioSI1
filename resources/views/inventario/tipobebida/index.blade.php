@extends ('layouts.admin')
@section ('contenido')
<!--tipobebidas-->
<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3>Listado de tipo de bebida
			@can('inventario.tipobebida.create')
				<a href="tipobebida/create"><button class="btn 	btn-success">Nuevo</button></a>
			@endcan
		</h3>
		@include('inventario.tipobebida.search')
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
               			@foreach ($tipobebidas as $tib)
				<tr>
					<td>{{ $tib->idTipoBebida}}</td>
					<td>{{ $tib->tipo}}</td>				
					<td>
					@can('inventario.tipobebida.edit')
						<a href="{{URL::action('TipoBebidaController@edit',$tib->idTipoBebida)}}"><button class="btn btn-info">Editar</button></a>
					@endcan
					@can('inventario.tipobebida.destroy')
                         				<a href="" data-target="#modal-delete-{{$tib->idTipoBebida}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
					@endcan
					</td>
				</tr>
				@include('inventario.tipobebida.modal')
				@endforeach
			</table>
		</div>
		<!--mostrar la paginacion--> 
		{{$tipobebidas->render()}} <!--paso la  variable pasada del controlador-->
	</div>
</div>

@endsection