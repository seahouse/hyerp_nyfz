@extends('navbarerp')

@section('main')
    <h1>添加出库信息</h1>
    <hr/>
    
    {!! Form::open(['url' => 'inventory/warehouseoutitems', 'class' => 'form-horizontal']) !!}
        @include('inventory.warehouseoutitems._form',
            [
                'attr' => '',
                'submitButtonText' => '添加'
            ])
    {!! Form::close() !!}    

    
    @include('errors.list')
    @include('basic.materials._selectmaterialmodal')
    @include('sales.soheads._selectsalesordermodal')
@stop

@section('script')
    @component('basic.materials._selectmaterialjs')
        $("#material_name").val(field.name);
        $("#material_id").val(field.id);
    @endcomponent

    @component('sales.soheads._selectsalesorderjs')
        $("#sohead_name").val(field.name);
        $("#sohead_id").val(field.id);
    @endcomponent
@endsection
