@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Editar Zona Empleado: {{$empleado->nombre}}</h3>
			@if (count($errors)>0)
			<div class="alert alert-danger">
				<ul>
				@foreach ($errors->all() as $error)
					<li>{{$error}}</li>
				@endforeach
				</ul>
			</div>
			@endif
			{!!Form::model($zonaem,['method'=>'PATCH','route'=>['zonaempleado.update',$zonaem->ci]])!!}
            {{Form::token()}}
            <div class="row">
            <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                    <div class="fomr-group">
                    <ul class="list-unstyled">
                                    <label>
                                    {{ Form::checkbox('dias[]', 'Lunes', null) }}
                                    Lunes
                                    
                                    </label>
                                    <label>
                                    {{ Form::checkbox('dias[]', 'Martes', null) }}
                                    Martes
                                   
                                    </label>
                                    <label>
                                    {{ Form::checkbox('dias[]', 'Miercoles', null) }}
                                    Miercoles
                                    
                                    </label>
                                    <label>
                                    {{ Form::checkbox('dias[]', 'Jueves', null) }}
                                    Jueves
                                   
                                    </label>
                                    <label>
                                    {{ Form::checkbox('dias[]', 'Viernes', null) }}
                                    Viernes
                                  
                                    </label>
                                    <label>
                                    {{ Form::checkbox('dias[]', 'Sabado', null) }}
                                   Sabado
                                    
                                    </label>
                                
                            </ul>
                                                
                    </div>                 
                </div>
                
            <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                    <div class="form-group"><!--TODO SE SACA DEL REQUEST-->
                        <label>Zona</label>
                        <select name="idzona" class="form-control">
                            @foreach($zona as $ze)
                                <option value="{{$ze->idZona}}">{{$ze->nombre}}</option>
                            @endforeach
                        </select>
                    </div>           
                </div>
            </div>
            <div class="form-group">
            	<button class="btn btn-primary" type="submit">Guardar</button>
            	<button class="btn btn-danger" type="reset">Cancelar</button>
            </div>

			{!!Form::close()!!}		
            
		</div>
	</div>
@endsection