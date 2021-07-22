@extends('layouts.admin')

@section('contenido')
<div class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">Roles</div>

                <div class="panel-body">                    
                    {!! Form::model($role, ['route' => ['roles.update', $role->id],
                    'method' => 'PUT']) !!}

                        @include('roles.partials.form')
                        
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection