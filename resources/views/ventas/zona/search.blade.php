<!--la url para que envie la infformacion de este form a la pagina index -->
<!--metodo de enviio ser GET , permite filtrar a las TIPOS DE PRODUTO tipoproducto controllerr  -->
<!--Note que hay un serarchText-->
<!--rol es de tipo buscqueda-->
{!! Form::open(array('url'=>'ventas/zona','method'=>'GET','autocomplete'=>'off','role'=>'search')) !!}
<div class="form-group">
	<div class="input-group">
		<input type="text" class="form-control" name="searchText" placeholder="Buscar..." value="{{$searchText}}">
		<span class="input-group-btn">
			<button type="submit" class="btn btn-primary">Buscar</button>
		</span>
	</div>
</div>

{{Form::close()}}
