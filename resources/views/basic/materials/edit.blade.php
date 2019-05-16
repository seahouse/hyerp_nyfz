@extends('navbarerp')

@section('main')
    <h1>编辑</h1>
    <hr/>
    
    {!! Form::model($material, ['method' => 'PATCH', 'action' => ['Basic\MaterialController@update', $material->id],'class' => 'form-horizontal', 'files' => true]) !!}
        @include('basic.materials._form', ['submitButtonText' => '保存'])
    {!! Form::close() !!}
    
    @include('errors.list')
@stop

