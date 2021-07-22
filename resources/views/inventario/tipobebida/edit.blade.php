@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Editar Tipo: {{ $tipobebidas->tipo}}</h3>
			@if (count($errors)>0)
			<div class="alert alert-danger">
				<ul>
				@foreach ($errors->all() as $error)
					<li>{{$error}}</li>
				@endforeach
				</ul>
			</div>
			@endif

			{!!Form::model($tipobebidas,['method'=>'PATCH','route'=>['tipobebida.update',$tipobebidas->idTipoBebida]])!!}
            {{Form::token()}}
            <div class="form-group">
            	<label for="tipo">Tipo</label>
            	<input type="text" name="tipo" class="form-control" value="{{$tipobebidas->tipo}}" placeholder="Tipo...">
            </div>
            <div class="form-group">
            	<button class="btn btn-primary" type="submit">Guardar</button>
            	<button class="btn btn-danger" type="reset">Cancelar</button>
            </div>

			{!!Form::close()!!}		
            
		</div>
	</div>
@endsection