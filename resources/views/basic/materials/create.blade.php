@extends('navbarerp')

@section('main')
    <h1>添加物料信息</h1>
    <hr/>
    
    {!! Form::open(['url' => 'basic/materials','class' => 'form-horizontal']) !!}
        @include('basic.materials._form',
                [
                'submitButtonText' => '添加',
                'attr'  => ''
                ])
    {!! Form::close() !!}

    @include('errors.list')
    @include('basic.material_cats._selectmaterial_catmodal')
@stop

@section('script')
    @component('basic.material_cats._selectmaterial_catjs')
        $("#material_cat_name").val(field.name);
        $("#material_cat_id").val(field.id);
    @endcomponent

    {{--@include('purchase.vendors._selectvendorjs')--}}
@endsection