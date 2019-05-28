@extends('navbarerp')

@section('main')
    <h1>添加入库单</h1>
    <hr/>
    
    {!! Form::open(['url' => 'inventory/warehouseinheads', 'class' => 'form-horizontal']) !!}
        @include('inventory.warehouseinheads._form',
            [
                'submitButtonText' => '添加',
                'attr'  => '',
            ])
    {!! Form::close() !!}
    

    @include('errors.list')
    @include('purchase.purchaseorders._selectpoheadmodal')
    @include('purchase.vendors._selectvendormodal')
@stop

@section('script')
    @component('purchase.purchaseorders._selectpoheadjs')
        $("#pohead_name").val(field.name);
        $("#pohead_id").val(field.id);
    @endcomponent

    @include('purchase.vendors._selectvendorjs')
@endsection