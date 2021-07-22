@extends ('layouts.admin')
@section ('contenido')
<!--tipobebidas-->
<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3>Inventarios
		<td>
			@can('inventario.create')
			<a href="inventario/create"><button class="btn 	btn-success">Nuevo</button></a>
			@endcan
		</td>
		</h3>
		@include('inventario.search')
	</div>
</div>

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover">
				<thead>
					<th>Producto</th>
					<th>Stock</th>
					<th>Stock Minimo</th>	
					<th>Stock Maximo</th>			
					<th>Imagen</th>
					<th>Opciones</th>
				</thead>
				<!--variable recibida dese el controlador $tipobebidas-->
               			@foreach ($productos as $p)
				<tr>
					<td>{{ $p->producto}}</td>
					<td>{{ $p->stock}}</td>
					<td>{{ $p->minStock}}</td>
					<td>{{ $p->maxStock}}</td>
					<!--quite tipo-->
					<td>
						<img src="{{asset('imagenes/producto/'.$p->imagen)}}" alt="{{$p->descripcion}}" height="100px" width="100px" class="img-thumbnail">
					</td>	
						
					<td>
					@can('inventario.edit')
						<a href="{{URL::action('InventarioController@edit',$p->idProd)}}"><button class="btn btn-info">Editar</button></a>
					@endcan
					@can('inventario.destroy')
                         				<a href="" data-target="#modal-delete-{{$p->idProd}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
					@endcan
					</td>
				</tr>
				@include('inventario.modal')
				@endforeach
			</table>
		</div>
		<!--mostrar la paginacion--> 
		{{$productos->render()}} <!--paso la  variable pasada del controlador-->
	</div>
</div>

@endsection