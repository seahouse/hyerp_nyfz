@extends('navbarerp')

@section('main')
    <h1>编辑</h1>
    <hr/>
    
    {!! Form::model($material_cat, ['method' => 'PATCH', 'action' => ['Basic\Material_catController@update', $material_cat->id],'class' => 'form-horizontal', 'files' => true]) !!}
        @include('basic.material_cats._form', ['submitButtonText' => '保存'])
    {!! Form::close() !!}
    
    @include('errors.list')
@stop

