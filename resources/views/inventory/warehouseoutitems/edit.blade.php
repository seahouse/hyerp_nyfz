@extends('navbarerp')

@section('main')
    <h1>编辑</h1>
    <hr/>
    
    {!! Form::model($warehouseoutitem, ['method' => 'PATCH', 'action' => ['Inventory\WarehouseoutitemController@update', $warehouseoutitem->id], 'class' => 'form-horizontal']) !!}
        @include('inventory.warehouseoutitems._form',
            [
                'submitButtonText' => '保存',
                'attr' => '',
                'btnclass' => 'btn btn-primary',
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