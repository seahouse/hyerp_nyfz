@extends('navbarerp')

@section('main')
    <h1>编辑</h1>
    <hr/>
    
    {!! Form::model($warehouseinhead, ['method' => 'PATCH', 'action' => ['Inventory\WarehouseinheadController@update', $warehouseinhead->id], 'class' => 'form-horizontal']) !!}
        @include('inventory.warehouseinheads._form',
            [
                'submitButtonText' => '保存',
                'attr' => '',
                'btnclass' => 'btn btn-primary',
            ])
    {!! Form::close() !!}
    
    @include('errors.list')

    @include('purchase.purchaseorders._selectpoheadmodal')
    @include('purchase.vendors._selectvendormodal')
@endsection

@section('script')
    @component('purchase.purchaseorders._selectpoheadjs')
        $("#pohead_name").val(field.name);
        $("#pohead_id").val(field.id);
    @endcomponent

    {{--@include('sales.soheads._selectsalesorderjs')--}}

    @include('purchase.vendors._selectvendorjs')
@endsection
