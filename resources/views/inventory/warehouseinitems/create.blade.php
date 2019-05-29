@extends('navbarerp')

@section('main')
    <h1>添加入库信息</h1>
    <hr/>
    
    {!! Form::open(['url' => 'inventory/warehouseinitems', 'class' => 'form-horizontal']) !!}
        @include('inventory.warehouseinitems._form',
            [
                'attr' => '',
                'submitButtonText' => '添加'
            ])
    {!! Form::close() !!}    

    
    @include('errors.list')
    @include('basic.materials._selectmaterialmodal')
@stop

@section('script')
    @component('basic.materials._selectmaterialjs')
        $("#material_name").val(field.name);
        $("#material_id").val(field.id);
    @endcomponent
@endsection
