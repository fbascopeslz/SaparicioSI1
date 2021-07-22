@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Editar Nombre: {{ $users->name}}</h3>
			@if (count($errors)>0)
			<div class="alert alert-danger">
				<ul>
				@foreach ($errors->all() as $error)
					<li>{{$error}}</li>
				@endforeach
				</ul>
			</div>
			@endif
			{!!Form::model($empleado,['method'=>'PATCH','route'=>['user.update',$empleado->ci]])!!}
            {{Form::token()}}
           <!-- <div class="form-group">
            	<label for="name">Nombre</label>
            	<input type="text" name="nombre" class="form-control" value="{{$persona->nombre}}" placeholder="Nombre...">
            </div>
            <div class="form-group">
                <label for="paterno">Paterno</label>
                <input type="text" name="paterno" class="form-control" value="{{$persona->paterno}}" placeholder="Nombre...">
            </div>
            <div class="form-group">
                <label for="name">Materno</label>
                <input type="text" name="materno" class="form-control" value="{{$persona->materno}}" placeholder="Nombre...">
            </div>-->
          <!--  <div class="form-group">
            	<label for="email">email</label>
            	<input type="email" name="email" class="form-control" value="{{$users->email}}" placeholder="Nombre...">
            </div>
            <div class="form-group">
            	<label for="codigo">Codigo</label>
            	<input type="text" name="codigo" class="form-control" value="{{$empleado->codigo}}" placeholder="Nombre...">
            </div>-->
            <div class="form-group">
                <label for="telefono">Telefono</label>
                <input type="text" name="telefono" class="form-control" required  value="{{$persona->telefono}}" placeholder="Telefono...">
            </div>
            <div class="form-group">
                        <label for="">Cargo</label>
                        <select class="form-control" name="idcar" id="" data-Live-search="true">
                            @foreach($cargos as $cargo)
                                <option required  value="{{$cargo -> idCargo}}">{{$cargo -> cargo}}</option>
                            @endforeach
                        </select>
             </div>
             <div class="form-group">
                <label for="codigo">Codigo</label>
                <input type="number" name="codigo" class="form-control" required value="{{$empleado->codigo}}" placeholder="algo">
            </div>

            <div class="form-group">
            	<button class="btn btn-primary" type="submit">Guardar</button>
            	<button class="btn btn-danger" type="reset">Cancelar</button>
            </div>

{!!Form::close()!!}		
            
		</div>
	</div>
@endsection