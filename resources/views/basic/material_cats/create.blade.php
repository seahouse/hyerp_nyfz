@extends('navbarerp')

@section('main')
    <h1>添加物料类别</h1>
    <hr/>
    
    {!! Form::open(['url' => 'basic/material_cats','class' => 'form-horizontal']) !!}
        @include('basic.material_cats._form', ['submitButtonText' => '添加'])
    {!! Form::close() !!}

    @include('errors.list')
@stop
