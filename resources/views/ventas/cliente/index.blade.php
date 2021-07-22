@extends ('layouts.admin') 
@section ('contenido')
<div class="row">
    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
        <h3>Listado de Clientes 
        <td>
                @can('ventas.cliente.create')
                <a href="cliente/create"><button class="btn btn-success">Nuevo</button></a>
                @endcan
        </td>
        </h3>
         @include('ventas.cliente.search') </div>
</div>
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-condensed table-hover">
                <thead>
                    <th>CI</th>
                    <th>Nombre</th>
                    <th>Tipo de Cliente</th> 
                    <th>Telefono</th>                      
                    <th>Opciones</th>
                </thead>
                @foreach($clientes as $ing)
                <tr>
                    <td>{{$ing -> ci}}</td>
                    <td>{{$ing -> nombreCliente}}</td>
                    <td>{{$ing-> tipo}}</td>
                    <td>{{$ing -> telefono}}</td>                  
                                      
                    <td>
                    @can('ventas.cliente.edit')
                        <a href="{{URL::action('ClienteController@show', $ing ->ci)}}">
                            <button class="btn btn-primary">Detalles</button>
                        </a>
                    @endcan
                    @can('ventas.cliente.destroy')
                        <a href="" data-target="#modal-delete-{{$ing -> ci}}" data-toggle="modal">
                            <button class="btn btn-danger">Anular</button>
                        </a>
                    @endcan
                    </td>
                </tr> 
                @include('ventas.cliente.modal')
                @endforeach </table>
        </div>
         {{$clientes -> render()}}
    </div>
</div> 
@endsection