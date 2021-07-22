@extends ('layouts.admin')
@section ('contenido')
    <div class="row">
        <div class="col-lg-8 col-md-6 col-sm-6 col-xs-12">
            <h3>Nuevo personal</h3>
            @if (count($errors)>0)
            <div class="alert alert-danger">
                <ul>
                <!--errors lo RECIVIMOS DEL ARCHIVO REQUEST-->
                @foreach ($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
                </ul>
            </div>
            @endif
            </div>
    </div>
            <!--enviar parametros -->
            <!--URL envia desde web, con post llama a store TipoBebida controller-->
            {!!Form::open(array('url'=>'personal/user','method'=>'POST','autocomplete'=>'off'))!!}
            {{Form::token()}} <!---->
                <div class="row">
                <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12"> 
                <div class="form-group">
                    <label for="ci">CI</label><!---->
                    <input type="number" name="ci" class="form-control" placeholder="ci..."><!--name="tipo" tipo es reconocido por TBformRequest-->
                    <!--Tambien es usado por TBController en el metodo store-->
                </div>
                 </div>
                <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                <div class="form-group">
                    <label for="nombre">Nombre</label><!---->
                    <input type="text" name="nombre" class="form-control" placeholder="Nombre..."><!--name="tipo" tipo es reconocido por TBformRequest-->
                    <!--Tambien es usado por TBController en el metodo store-->
                </div>
                 </div>
                <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                <div class="form-group">
                    <label for="paterno">Apellido</label><!---->
                    <input type="text" name="paterno" class="form-control" placeholder="Paterno..."><!--name="tipo" tipo es reconocido por TBformRequest-->
                    <!--Tambien es usado por TBController en el metodo store-->
                </div>
                 </div>
                <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                <div class="form-group">
                    <label for="materno">Materno</label><!---->
                    <input type="text" name="materno" class="form-control" placeholder="Materno..."><!--name="tipo" tipo es reconocido por TBformRequest-->
                    <!--Tambien es usado por TBController en el metodo store-->
                </div>
                 </div>
                <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                <div class="form-group">
                    <label for="telefono">Telefono</label><!---->
                    <input type="text" name="telefono" class="form-control" placeholder="telefono..."><!--name="tipo" tipo es reconocido por TBformRequest-->
                    <!--Tambien es usado por TBController en el metodo store-->
                </div>
             </div>
                <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                <div class="form-group">            
                    <label for="sexo">Sexo:</label>
                    <select name="sexo" id="" class="form-control">                  
                       <option value="M">Masculino</option> 
                       <option value="F">Femenino</option> 
                       <option value="O">Otros</option>
                    </select>
                 </div>
                  </div>
                <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                    <div class="form-group">
                        <label for="">Cargo</label>
                        <select class="form-control" name="idcar" id="" data-Live-search="true">
                            @foreach($cargos as $cargo)
                                <option value="{{$cargo -> idCargo}}">{{$cargo -> cargo}}</option>
                            @endforeach
                        </select>
                    </div> 
                     </div>
                <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                    <div class="form-group">
                    <label for="Codigo">Codigo</label><!---->
                    <input type="text" name="codigo" class="form-control" placeholder="codigo..."><!--name="tipo" tipo es reconocido por TBformRequest-->
                    <!--Tambien es usado por TBController en el metodo store-->
                </div>
                 </div>
                <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">         
                <div class="form-group">
                    <label for="email">Email</label><!---->
                    <input type="email" name="email" class="form-control" placeholder="Email..."><!--name="tipo" tipo es reconocido por TBformRequest-->
                    <!--Tambien es usado por TBController en el metodo store-->
                </div>
                 </div>
                <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                <div class="form-group">
                    <label for="password">Contraseña</label><!---->
                    <input type="password" name="password" class="form-control" placeholder="password..."><!--name="tipo" tipo es reconocido por TBformRequest-->
                    <!--Tambien es usado por TBController en el metodo store-->
                </div>
                 </div>
                <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">            
                <div class="form-group">
                    <button class="btn btn-primary" type="submit">Guardar</button>
                    <button class="btn btn-danger" type="reset">Cancelar</button>
                </div>
                 </div>
            {!!Form::close()!!}              
@endsection