@extends ('layouts.admin') 
@section ('contenido')
<div class="row">
    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
        <h3>Listado de Ingresos
        <td> 
            @can('compras.ingreso.create')
            <a href="ingreso/create"><button class="btn btn-success">Nuevo</button></a>
            @endcan
        </td>
        </h3>
         @include('compras.ingreso.search') </div>
</div>
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-condensed table-hover">
                <thead>
                    <th>ID</th>
                    <th>Fecha</th>
                    <th>Proveedor</th>
                    <th>comprobante</th>
                     <th>Impuesto</th>
                    <th>Total</th> 
                    <th>Estado</th>                      
                    <th>Opciones</th>
                </thead>
                @foreach($ingresos as $ing)
                <tr>
                    <td>{{$ing -> idIngreso}}</td>
                    <td>{{$ing -> fecha}}</td>
                    <td>{{$ing -> nombre}}</td>
                    <td>{{$ing -> tipoComprobante.':   '.$ing -> serieComprobante.' -  '.$ing -> numComprobante}}</td>
                    <td>{{$ing -> impuesto}}</td>
                    <td>{{$ing -> total1}}</td>                    
                    <td>{{$ing -> estado}}</td>                    
                    <td>
                        @can('compras.ingreso.show')
                            <a href="{{URL::action('IngresoController@show', $ing -> idIngreso)}}">
                                <button class="btn btn-primary">Detalles</button>
                            </a>
                        @endcan
                        @can('compras.ingreso.destroy')
                        <a href="" data-target="#modal-delete-{{$ing -> idIngreso}}" data-toggle="modal">
                            <button class="btn btn-danger">Anular</button>
                        </a>
                        @endcan
                    </td>
                </tr> 
                @include('compras.ingreso.modal')
                @endforeach </table>
        </div>
         {{$ingresos -> render()}}
    </div>
</div> 
@endsection