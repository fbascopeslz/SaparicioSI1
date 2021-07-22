@extends ('layouts.admin') 
@section ('contenido')
<div class="row">
    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
        <h3>Listado de Entregas
        <td> 
            @can('ventas.entrega.create')
            <a href="entrega/create"><button class="btn btn-success">Nuevo</button></a>
            @endcan
        </td>
        </h3>
         @include('ventas.entrega.search') </div>
</div>
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-condensed table-hover">
                <thead>
                    <th>ID</th>
                    <th>FechaPedido</th>
                    <th>Codigo Prom</th>
                     <th>Promotor</th>
                    <th>Cliente</th> 
                    <th>Estado</th>
                                    
                    <th>Opciones</th>
                </thead>
                @foreach($ventas as $ing)
                <tr>
                    <td>{{$ing -> idventa}}</td>
                    <td>{{$ing -> fecha}}</td>
                    <td>{{$ing -> codigo}}</td>
                    <td>{{$ing -> nombrep}}</td>
                    <td>{{$ing -> nombrec}}</td>
                    <td>{{$ing -> estado}}</td>                    
                    <td>
                        @can('ventas.entrega.show')
                            <a href="{{URL::action('EntregaController@show', $ing -> idventa)}}">
                                <button class="btn btn-primary">Detalles</button>
                            </a>
                        @endcan
                        @can('ventas.entrega.destroy')
                        <a href="" data-target="#modal-delete-{{$ing -> idventa}}" data-toggle="modal">
                            <button class="btn btn-danger">Entregar</button>
                        </a>
                        @endcan
                    </td>
                </tr> 
                @include('ventas.entrega.modal')
                @endforeach </table>
        </div>
         {{$ventas -> render()}}
    </div>
</div> 
@endsection