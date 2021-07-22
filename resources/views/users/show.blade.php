@extends('layouts.admin')

@section('contenido')
<div class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">Usuario</div>

                <div class="panel-body">                                        
                    <p><strong>Nombre</strong>     {{ $user->name }}</p>
                    <p><strong>Email</strong>      {{ $user->email }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection